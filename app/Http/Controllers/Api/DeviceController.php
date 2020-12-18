<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Services\System\FieldService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Device\DeviceService;

class DeviceController extends Controller
{
    /**
     * @var DeviceService.
     */
    protected $deviceService;

    /**
     * @var FieldService.
     */
    protected $fieldService;
    public function __construct(DeviceService $deviceService, FieldService $fieldService)
    {
        $this->deviceService = $deviceService;
        $this->fieldService = $fieldService;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $device = array_shift($data);
            $device = $this->deviceService->create([
                'code_device' => $device['id']
            ]);

            $deviceFields = $this->fieldService->prepareFieldsAndSave($request->except('_token'));
            // vincular com dispositivos
            $this->deviceService->saveFields($device, $deviceFields);

            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false]);
        }
    }
}
