<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                'name' => Str::random(10),
                'license_plate' => Str::random(3) . '-' . rand(4, 4),
                'created_by' => 12,
                'updated_by' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => Str::random(10),
                'license_plate' => Str::random(3) . '-' . rand(4, 4),
                'created_by' => 12,
                'updated_by' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => Str::random(10),
                'license_plate' => Str::random(3) . '-' . rand(4, 4),
                'created_by' => 12,
                'updated_by' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => Str::random(10),
                'license_plate' => Str::random(3) . '-' . rand(4, 4),
                'created_by' => 12,
                'updated_by' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach($vehicles as $vehicle) {
            DB::table('vehicle')->insert($vehicle);
        }

    }
}
