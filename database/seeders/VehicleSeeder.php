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
        for ($i = 0; $i <= 20; $i++) {
            $vehicle = [
                'name' => 'Caminhão - ' . Str::random(10),
                'license_plate' => strtoupper(Str::random(3)) . '-' . rand(1000, 9999),
                'created_by' => 12,
                'updated_by' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $exist = DB::table('vehicle')->where('license_plate', '=', $vehicle['license_plate'])->exists();
            if(!$exist) {
                DB::table('vehicle')->insert($vehicle);
            }
        }
    }
}
