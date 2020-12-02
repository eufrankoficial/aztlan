<?php

namespace Database\Seeders;

use App\Models\Device;
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
            $collection  = [
                [
                    'device' => [
                        'device_data' => [
                            'vehicle_id' => $v->id,
                            'code_device' => strtoupper(Str::random(10)),
                            'description' => Str::random(20),
                        ],
                        'device_detail' => [
                            [
                                'description' => Str::random(10),
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
                                'description' => Str::random(10),
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
                                'stamp' => now()->subDays(2),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now()->subDays(2),
                                'updated_at' => now()->subDays(2),
                            ],
                            [
                                'description' => Str::random(10),
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
                                'stamp' => now()->subDays(3),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now()->subDays(3),
                                'updated_at' => now()->subDays(3),
                            ],
                            [
                                'description' => Str::random(10),
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
                                'stamp' => now()->subDays(4),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now()->subDays(4),
                                'updated_at' => now()->subDays(4),
                            ],
                            [
                                'description' => Str::random(10),
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
                                'stamp' => now()->subDays(5),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now()->subDays(5),
                                'updated_at' => now()->subDays(5),
                            ],
                        ]
                    ],
                ],
                [
                'device' => [
                    'device_data' => [
                        'vehicle_id' => $v->id,
                        'code_device' => strtoupper(Str::random(10)),
                        'description' => Str::random(20),
                    ],
                    'device_detail' => [
                        [
                            'description' => Str::random(10),
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
                            'description' => Str::random(10),
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
                            'stamp' => now()->subDays(2),
                            'created_by' => 12,
                            'updated_by' => 12,
                            'created_at' => now()->subDays(2),
                            'updated_at' => now()->subDays(2),
                        ],
                        [
                            'description' => Str::random(10),
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
                            'stamp' => now()->subDays(3),
                            'created_by' => 12,
                            'updated_by' => 12,
                            'created_at' => now()->subDays(3),
                            'updated_at' => now()->subDays(3),
                        ],
                        [
                            'description' => Str::random(10),
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
                            'stamp' => now()->subDays(4),
                            'created_by' => 12,
                            'updated_by' => 12,
                            'created_at' => now()->subDays(4),
                            'updated_at' => now()->subDays(4),
                        ],
                        [
                            'description' => Str::random(10),
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
                            'stamp' => now()->subDays(5),
                            'created_by' => 12,
                            'updated_by' => 12,
                            'created_at' => now()->subDays(5),
                            'updated_at' => now()->subDays(5),
                        ],
                    ]
                ],
            ]
            ];

            foreach($collection as $devicesList) {
                foreach($devicesList as $device) {
                    $deviceDb = Device::create($device['device_data']);
                    foreach($device['device_detail'] as $detail) {
                        $detail['device_id'] = $deviceDb->id;
                        DB::table('device_detail')->insert($detail);
                    }
                }
            }
        }
    }
}
