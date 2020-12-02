<?php

namespace App\ViewModels;

use App\Services\Device\DeviceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class DashboardViewModel extends ViewModel
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function devices(): LengthAwarePaginator
    {
        return $this->deviceService->getDeviceList();
    }
}
