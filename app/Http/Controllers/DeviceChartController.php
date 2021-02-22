<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceChartRequest;
use App\Models\Device;
use App\Repositories\Device\DeviceRepository;
use App\Services\Device\DeviceChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getDataChart(Device $device, Request $request)
    {
        try {
            $initialDate = $request->get('initialDate');
            if ($request->get('initialTime')) {
                $time = extractHourAndMinutesFromTime($request->get('initialTime'));
                $initialDate = mountDateWithHourAndMinute($initialDate, (int) $time['hour'], $time['minutes']);
            }

            $finalDate = $request->get('finalDate');
            if ($request->get('finalTime')) {
                $finalTime = extractHourAndMinutesFromTime($request->get('finalTime'));
                $finalDate = mountDateWithHourAndMinute($finalDate, (int) $finalTime['hour'], $finalTime['minutes']);
            }

            $filters = $request->except('_token');
            $filters['initialDate'] = Carbon::parse($initialDate)->format('d/m/Y H:i');
            $filters['finalDate'] = Carbon::parse($finalDate)->format('d/m/Y H:i');

            $request->merge($filters);
            $chart = $this->deviceChartService->getDataChart($device, $request);

            return response()->json([
                'data' => $chart,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
