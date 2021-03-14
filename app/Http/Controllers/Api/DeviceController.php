<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequestDeviceStore;
use App\Repositories\Device\DeviceTmpRepository;
use App\Services\Device\DeviceService;
use App\Services\System\FieldService;
use App\Services\System\JobService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    /**
     * @var deviceService
     */
    protected $deviceService;

    /**
     * @var fieldService
     */
    protected $fieldService;

    /**
     * @var deviceTmpRepository
     */
    protected $deviceTmpRepo;

    public function __construct(DeviceTmpRepository $deviceTmpRepo)
    {
        $this->deviceTmpRepo = $deviceTmpRepo;
    }

    // Implementar a url de confirmação
    public function store(ApiRequestDeviceStore $request)
    {
        try {
            DB::beginTransaction();
            $this->deviceTmpRepo->createTmpDevice($request);

            DB::commit();

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->jobService->createJobOnQueue($request->all());
            Log::info('Request data: '.json_encode($request->all()));
            Log::info('Request header: '.json_encode($request->header()));
            Log::error($e->getMessage());

            return response()->json(['status' => false]);
        }
    }
}
