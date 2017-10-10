<?php

namespace App\Providers;

use App\Models\Backend\SidebarMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backend.layouts.sidebar_menu', function ($view) {
            // Get backend sidebar menus
            $sidebarMenu = new SidebarMenu();
            $menus = $sidebarMenu->getHtmlOfMenus();
            $view->with('sidebar_menus', $menus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
