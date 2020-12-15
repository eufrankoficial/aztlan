<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(base_path('seeds/menus.json'));
        $file = json_decode($file);

        \DB::table('menu')->delete();
        foreach($file->menus as $menu) {
            \DB::table('menu')->insert((array)$menu);
        }
    }
}
