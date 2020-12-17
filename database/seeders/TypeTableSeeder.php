<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = file_get_contents(base_path('seeds/types.json'));
        $types = json_decode($types);

        foreach ($types->types as $type) {
            $menu = Type::where('slug', $type->slug)->first();
            if(!$menu) {
                Type::create((array)$type);
            }
        }
    }
}
