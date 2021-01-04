<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequestDeviceStore;
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

    public function store(ApiRequestDeviceStore $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $device = $data;

            $device = $this->deviceService->save([
                'code_device' => $device['id']
            ]);

            $this->fieldService->prepareFieldsAndSave($request->except('_token'), $device);

            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false]);
        }
    }
}
