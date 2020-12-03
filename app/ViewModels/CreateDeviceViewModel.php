<?php

namespace App\ViewModels;

use App\Services\Device\DeviceService;
use Spatie\ViewModels\ViewModel;

class CreateDeviceViewModel extends ViewModel
{
    protected $deviceService;

    public function __construct(DeviceService  $deviceService)
    {
        $this->deviceService = $deviceService;
    }
}
