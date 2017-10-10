<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SidebarMenu extends Model {
    private $active_ids = [];
    private $found_depth = 1;
    private $found_flag = 0;     // If find the url in menus, it will be set as 1
    private $menu_html = '';

    public function getActiveIds() {
        $menus = config('constants.sidebar_menus');

        // Get current url suffix
        $pos = strpos(url()->current(), url('/'));
        if ($pos !== false ) {
            $url = substr( url()->current(), strlen(url('/')) );
            if ($url == '')
                $url = '/';
        } else {
            $url = '/';
        }

        // When url have "/edit", replace id number as {id}. Ex: /edit/10 => /edit/{id}
        $pos = strpos($url, '/edit');
        if( $pos !== false ) {
            $url = substr($url, 0, $pos + 6) . '{id}';
        }

        for($i = 0; $i < count($menus); $i++) {
            if($this->found_flag)
                break;

            $menu = $menus[$i];
            if( $menu['url'] == $url ) {
                $this->active_ids = [0 => $menu['id']];
                $this->found_depth = 1;
                break;
            } else {
                if( !count($menu['children']) )
                    continue;

                $this->active_ids = [0 => $menu['id']];
                $this->checkUrlInChildMenus($url, $menu['children'], 2);
            }
        }

        $active_ids = [];
        for($i = 0; $i < $this->found_depth; $i++) {
            $active_ids[] = $this->active_ids[$i];
        }

        $this->active_ids = $active_ids;
    }

    public function checkUrlInChildMenus($url='/', $child_menus=[], $depth) {
        for($i = 0; $i < count($child_menus); $i++) {
            if($this->found_flag)
                break;

            $menu = $child_menus[$i];
            if( $menu['url'] == $url ) {
                $this->active_ids[$depth-1] = $menu['id'];
                $this->found_depth = $depth;
                $this->found_flag = 1;
                return;
            } else {
                if( !count($menu['children']) )
                    continue;
                $this->active_ids[$depth-1] = $menu['id'];
                $this->checkUrlInChildMenus($url, $menu['children'], $depth+1);
            }

        }
    }

    public function getHtmlOfChildMenus($menus=[]) {
        $this->menu_html .= '<ul class="sub-menu">';

        $user_level = Auth::user()->user_level;

        for($i = 0; $i < count($menus); $i++) {
            $menu = $menus[$i];

            if( $menu['hidden'] )
                continue;

            if (!in_array($user_level, $menu['user_level']))
                continue;

            if( in_array($menu['id'], $this->active_ids))
                $active = ' start active open';
            else
                $active = '';
            $this->menu_html .= '<li class="nav-item'. $active .'">';

            if( $menu['url'] )
                $href = url($menu['url']);
            else
                $href = 'javascript:;';
            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 )
                $nav_toggle = ' nav-toggle';
            else
                $nav_toggle = '';
            $this->menu_html .= '<a href="'. $href .'" class="nav-link'. $nav_toggle .'">';

            if( $menu['icon'] )
                $this->menu_html .= '<i class="'. $menu['icon'] .'"></i>';

            $this->menu_html .= '<span class="title">'. $menu['name'] .'</span>';

            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 ) {
                $this->menu_html .= '<span class="arrow"></span>';
            }

            $this->menu_html .= '</a>';

            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 ) {
                $this->getHtmlOfChildMenus($menu['children']);
            }

            $this->menu_html .= '</li>';
        }

        $this->menu_html .= '</ul>';
    }

    public function getHtmlOfMenus() {
        $menus = config('constants.sidebar_menus');

        $this->getActiveIds();

        $user_level = Auth::user()->user_level;

        for($i = 0; $i < count($menus); $i++) {
            $menu = $menus[$i];

            if (!in_array($user_level, $menu['user_level']))
                continue;

            if( $menu['hidden'] )
                continue;

            if( in_array($menu['id'], $this->active_ids))
                $active = ' start active open';
            else
                $active = '';
            $this->menu_html .= '<li class="nav-item'. $active .'">';

            if( $menu['url'] )
                $href = url($menu['url']);
            else
                $href = 'javascript:;';
            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 )
                $nav_toggle = ' nav-toggle';
            else
                $nav_toggle = '';
            $this->menu_html .= '<a href="'. $href .'" class="nav-link'. $nav_toggle .'">';

            if( $menu['icon'] )
                $this->menu_html .= '<i class="'. $menu['icon'] .'"></i>';

            $this->menu_html .= '<span class="title">'. $menu['name'] .'</span>';

            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 ) {
                $this->menu_html .= '<span class="arrow"></span>';
            }

            $this->menu_html .= '</a>';

            if( $menu['children'] && $menu['children'][0]['hidden'] == 0 ) {
                $this->getHtmlOfChildMenus($menu['children']);
            }

            $this->menu_html .= '</li>';
        }

        return $this->menu_html;
    }
}