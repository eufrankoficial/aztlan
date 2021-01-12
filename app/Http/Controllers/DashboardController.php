<?php

namespace App\Http\Controllers;

use App\Services\Device\DeviceService;
use App\ViewModels\DashboardViewModel;

class DashboardController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index()
    {
        return (new DashboardViewModel($this->deviceService))->view('device.index');
    }
}
