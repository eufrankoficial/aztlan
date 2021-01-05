<?php

namespace App\ViewModels;

use App\Models\Device;
use App\Services\Device\DeviceService;
use Spatie\ViewModels\ViewModel;
use App\Enums\ChartTypeEnum;

class DeviceDetailViewModel extends ViewModel
{
    /**
     * @var Device.
     */
    protected $device;

    /**
     * @var DeviceService.
     */
    protected $deviceService;

    public function __construct(DeviceService $deviceService, Device $device)
    {
        $this->deviceService = $deviceService;
        $this->device = $device;
        $this->device->load(['fields.value', 'charts']);
    }

    public function device(): Device
    {
        return $this->deviceService->show($this->device);
    }

    public function chartTypes()
    {
        $types = [
            ChartTypeEnum::LINE => 'Linha',
            ChartTypeEnum::PIE => 'Pizza'
        ];

        return json_encode($types);
    }

    public function chart()
    {
        return $this->deviceService->chart($this->device);
    }
}
