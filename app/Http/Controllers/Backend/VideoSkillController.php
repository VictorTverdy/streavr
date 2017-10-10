<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\VideoSkill;
use Illuminate\Support\Facades\Input;

class VideoSkillController extends Controller {
    /**
     * Show skills
     */
    public function showSkills() {
        return view('backend.video.skill.index');
    }

    /**
     * Save skill
     */
    public function saveSkill() {

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $skillClass = VideoSkill::find($id);
        } else {    // New
            $skillClass = new VideoSkill();
        }

        $skillClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $skillClass->slug = str_slug($slug);
        $skillClass->description = Input::get('description');
        $skillClass->save();

        return redirect('video/skills');
    }

    /**
     * Delete skill
     * @param int $id The skill id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSkill($id) {
        VideoSkill::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Edit skill
     */
    public function editSkill($id) {
        $skill = VideoSkill::find($id);

        return view('backend.video.skill.edit', ['skill' => $skill]);
    }
}