<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Device\DeviceService;

class DeviceController extends Controller
{
    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $devices = $this->prepareDateToSave($data);

            foreach($devices['devices'] as $code => $device) {
                $exist = Device::where('code_device', $code)->first();
                if(!$exist) {
                    $this->deviceService->create($device);
                } else {
                    $this->deviceService->update($device, $exist);
                }
            }

            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false]);
        }
    }

    private function prepareDateToSave(array $data)
    {
        $devices = [];
        foreach($data as $device) {
            $devices['devices'][$device['id']] = [
                'device' => [
                    'code_device' => $device['id']
                ],
                'detail' => [
                    'stamp' => $device['stamp'],
                    'bat' => $device['bat'],
                    'temp' => $device['temp'],
                    'umi' => $device['umi'],
                    'lon' => $device['lon'],
                    'cnt' => $device['cnt'],
                    'co2' => $device['co2'],
                    'lat' => $device['lat'],
                    'tempdht1' => $device['tempdht1'],
                    'umidht1' => $device['umidht1'],
                    'tempdht2' => $device['tempdht2'],
                    'umidht2' => $device['umidht2'],
                ]
            ];
        }

        return $devices;
    }


    public function update(Request $request, $id)
    {
        //
    }
}
