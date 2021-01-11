<?php

namespace Database\Seeders;

use App\Models\Menu;
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
            $m = Menu::create([
				"menu" => $menu->menu,
				"route" => $menu->route,
				"icon"  => $menu->icon,
				"order" => 8,
				"slug" => $menu->slug,
			]);

			if(!empty($menu->parents) && count($menu->parents) > 0) {
                foreach($menu->parents as $parent) {
					$p = (array) $parent;
					$p['parent_id'] = $m->id;
                    Menu::create($p);
                }
            }
        }
    }
}
