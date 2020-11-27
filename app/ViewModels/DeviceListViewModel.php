<?php

namespace App\ViewModels;

use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;
use App\Services\Device\DeviceService;

/**
 * Class DeviceListViewModel.
 * @package App\ViewModels.
 */
class DeviceListViewModel extends ViewModel
{
    /**
     * @var DeviceService.
     */
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
