<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\Device\DeviceReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(DeviceReportService $deviceReportService)
    {
        $this->deviceReportService = $deviceReportService;
    }

    public function exportDeviceHistory(Device $device, Request $request)
    {
        $report = $this->deviceReportService->exportDetail($device, $request);

        return view('device.report.detail', compact('report'));
    }
}
