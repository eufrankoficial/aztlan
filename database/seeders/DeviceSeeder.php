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
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 36.0,
                                'umi' => 60,
                                'cnt' => 0,
                                'co2' => 1000,
                                'tempdht1' => 34.6,
                                'tempdht2' => 34.5,
                                'umidht1' => 60,
                                'umidht2' => 60,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 35.0,
                                'umi' => 65,
                                'cnt' => 0,
                                'co2' => 1200,
                                'tempdht1' => 35.6,
                                'tempdht2' => 35.5,
                                'umidht1' => 65,
                                'umidht2' => 65,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 36.0,
                                'umi' => 70,
                                'cnt' => 0,
                                'co2' => 1100,
                                'tempdht1' => 36,
                                'tempdht2' => 36,
                                'umidht1' => 70,
                                'umidht2' => 70,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 35.9,
                                'umi' => 69,
                                'cnt' => 69,
                                'co2' => 1150,
                                'tempdht1' => 35.9,
                                'tempdht2' => 35.9,
                                'umidht1' => 69,
                                'umidht2' => 69,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
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
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 36.0,
                                'umi' => 60,
                                'cnt' => 0,
                                'co2' => 1000,
                                'tempdht1' => 34.6,
                                'tempdht2' => 34.5,
                                'umidht1' => 60,
                                'umidht2' => 60,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 35.0,
                                'umi' => 65,
                                'cnt' => 0,
                                'co2' => 1200,
                                'tempdht1' => 35.6,
                                'tempdht2' => 35.5,
                                'umidht1' => 65,
                                'umidht2' => 65,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 36.0,
                                'umi' => 70,
                                'cnt' => 0,
                                'co2' => 1100,
                                'tempdht1' => 36,
                                'tempdht2' => 36,
                                'umidht1' => 70,
                                'umidht2' => 70,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 35.9,
                                'umi' => 69,
                                'cnt' => 69,
                                'co2' => 1150,
                                'tempdht1' => 35.9,
                                'tempdht2' => 35.9,
                                'umidht1' => 69,
                                'umidht2' => 69,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
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
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 36.0,
                                'umi' => 60,
                                'cnt' => 0,
                                'co2' => 1000,
                                'tempdht1' => 34.6,
                                'tempdht2' => 34.5,
                                'umidht1' => 60,
                                'umidht2' => 60,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 3.24,
                                'temp' => 35.0,
                                'umi' => 65,
                                'cnt' => 0,
                                'co2' => 1200,
                                'tempdht1' => 35.6,
                                'tempdht2' => 35.5,
                                'umidht1' => 65,
                                'umidht2' => 65,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 36.0,
                                'umi' => 70,
                                'cnt' => 0,
                                'co2' => 1100,
                                'tempdht1' => 36,
                                'tempdht2' => 36,
                                'umidht1' => 70,
                                'umidht2' => 70,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                            [
                                'description' => Str::random(10),
                                'lon' => -47.565271591724105,
                                'lat' => -22.41384418630219,
                                'bat' => 4.24,
                                'temp' => 35.9,
                                'umi' => 69,
                                'cnt' => 69,
                                'co2' => 1150,
                                'tempdht1' => 35.9,
                                'tempdht2' => 35.9,
                                'umidht1' => 69,
                                'umidht2' => 69,
                                'stamp' => now(),
                                'created_by' => 12,
                                'updated_by' => 12,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ],
                        ]
                    ],
                ],
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
