<?php

use Illuminate\Database\Seeder;

class VideoCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_categories')->insert(
            array(
                'name' => 'Legends',
                'slug' => 'legends',
                'ordering' => 1
            )
        );
    }
}
