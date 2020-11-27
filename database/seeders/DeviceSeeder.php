<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = DB::table('vehicle')->get();

        foreach($vehicles as $v) {

            $devices = [
                [
                    'vehicle_id' => $v->id,
                    'code_device' => Str::random(10),
                    'description' => Str::random(20),
                    'lon' => -47.89376,
                    'lat' => -22.0631,
                    'bat' => 3.24,
                    'temp' => 36.18,
                    'umi' => 100,
                    'cnt' => 0,
                    'co2' => 466,
                    'tempdht1' => 34.6,
                    'tempdht2' => 34.5,
                    'umidht1' => 51.4,
                    'umidht2' => 48.2,
                    'stamp' => now(),
                    'created_by' => 12,
                    'updated_by' => 12,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'vehicle_id' => $v->id,
                    'code_device' => Str::random(10),
                    'description' => Str::random(20),
                    'lon' => -47.89376,
                    'lat' => -22.0631,
                    'bat' => 3.24,
                    'temp' => 36.18,
                    'umi' => 100,
                    'cnt' => 0,
                    'co2' => 466,
                    'tempdht1' => 34.6,
                    'tempdht2' => 34.5,
                    'umidht1' => 51.4,
                    'umidht2' => 48.2,
                    'stamp' => now(),
                    'created_by' => 12,
                    'updated_by' => 12,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            foreach($devices as $d) {
                DB::table('device')->insert($d);
            }
        }
    }
}
