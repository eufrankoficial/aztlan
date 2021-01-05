<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceChartRequest;
use App\Models\Device;
use App\Repositories\Device\DeviceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Device\DeviceChartService;

class DeviceChartController extends Controller
{

	protected $deviceChartService;
	protected $deviceRepository;

	public function __construct(DeviceChartService $deviceChartService, DeviceRepository $deviceRepository)
	{
		$this->deviceChartService = $deviceChartService;
		$this->deviceRepository = $deviceRepository;
	}

    public function save(Device $device, DeviceChartRequest $request)
    {
        try {
			DB::beginTransaction();

			$this->deviceChartService->saveChartConfig($device, $request->except('_token'));
			$device = $this->deviceRepository->with(['charts'])->findById($device->id);
			DB::commit();

			return response()->json(['status' => true, 'device' => $device]);

		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(['status' => false]);
		}
    }
}
