<?php

namespace App\ViewModels;

use App\Services\Vehicle\VehicleService;
use Spatie\ViewModels\ViewModel;

class CreateDeviceViewModel extends ViewModel
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function vehicles()
    {
        return $this->vehicleService->getToSelect();
    }
}
