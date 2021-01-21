<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequestDeviceStore;
use App\Services\System\FieldService;
use Illuminate\Support\Facades\DB;
use App\Services\Device\DeviceService;
use Illuminate\Support\Facades\Log;

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

    // Implementar a url de confirmação
    public function store(ApiRequestDeviceStore $request)
    {
		if(!empty($request->get('confirmationToken'))) {
			Log::info('AWS IOT request : token: ' . json_encode($request->get('confirmationToken')));
			Log::info('Request header: ' . json_encode($request->header()));
			return response()->json(['msg' => 'Validated'], 200);
		}

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
			Log::info('Request data: ' . json_encode($request->all()));
			Log::info('Request header: ' . json_encode($request->header()));
            return response()->json(['status' => false]);
        }
    }
}
