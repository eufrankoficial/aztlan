<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\Device\DeviceChartService;
use App\Services\Device\DeviceReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceReportController extends Controller
{
    public function __construct(DeviceReportService $deviceReportService, DeviceChartService $deviceChartService)
    {
        $this->deviceReportService = $deviceReportService;
        $this->deviceChartService = $deviceChartService;
    }

    public function generate(Device $device, Request $request)
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
            $filters['initialDate'] = $initialDate;
            $filters['finalDate'] = $finalDate;

            $request->merge($filters);
            $report = $this->deviceReportService->exportDetail($device, $request);

            $chart = $this->deviceChartService->getDataChart($device, $request)->toArray();
            $chart = json_encode($chart);

            return view('device.report.detail', compact('report', 'chart'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return 'É necessário fazer o filtro de datas nos gráficos para emitr o relatório';
        }
    }
}
