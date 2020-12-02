<?php

namespace App\Services\Device;

use App\Repositories\Device\DeviceRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DeviceService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function getDeviceList(): ?LengthAwarePaginator
    {
        $devices = $this->deviceRepo->all(15, true, ['detail']);
        $devices->map(function(&$device) {
            $detail = $device->detail;
            $device->status = 'success';
            $stamp = Carbon::parse($detail->stamp);
            $days = $stamp->diffInDays(Carbon::now());

            if($days > 1) {
                $device->status = 'danger';
            } elseif($days <= 1 && $days <> 0) {
                $device->status = 'warning';
            }
        });

        return $devices;
    }
}
