<?php

namespace App\ViewModels;

use App\Models\Device;
use Spatie\ViewModels\ViewModel;

class DeviceDetailViewModel extends ViewModel
{
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function device(): Device
    {
        return $this->device;
    }
}
