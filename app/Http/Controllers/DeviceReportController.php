<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\Device\DeviceReportService;
use Illuminate\Http\Request;

class DeviceReportController extends Controller
{
    public function __construct(DeviceReportService $deviceReportService)
	{
		$this->deviceReportService = $deviceReportService;
	}

	public function generate(Device $device, Request $request)
	{
		try {
			$report = $this->deviceReportService->exportDetail($device, $request);
			return view('device.report.detail', compact('report'));
		} catch (\Exception $e) {
			return 'É necessário fazer o filtro de datas nos gráficos para emitr o relatório';
		}
	}
}
