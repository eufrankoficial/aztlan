<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanyTableSeeder::class,
            RolesPermissionTableSeeder::class,
            MenuTableSeeder::class,
            VehicleSeeder::class,
            ChartTypeTableSeeder::class,
			TypeTableSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
