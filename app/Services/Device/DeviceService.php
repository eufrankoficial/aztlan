<?php

namespace App\Services\Device;

use App\Repositories\Device\DeviceRepository;
use App\Responses\Devices\DeviceDetailResponse;
use App\Services\Interfaces\BaseServiceInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
class DeviceService implements BaseServiceInterface
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function list(Request $request)
    {

    }

    public function create(array $data)
    {
        $device = $data['device'];
        $detail = $data['detail'];

        $model = $this->deviceRepo->create($device);
        $model->detail()->create($detail);

        return $model;
    }

    public function update(array $data, $device)
    {
        $device = $this->deviceRepo->update($device->id, $data['device']);
        $device->detail()->update($data['detail']);

        return $device;
    }

    public function delete($user)
    {

    }

    public function show($device)
    {
        return $device;
    }

    public function getDeviceList(): ?LengthAwarePaginator
    {
        $devices = $this->deviceRepo->all(15, true, ['detail']);
        $devices->map(function(&$device) {
            $detail = $device->detail;
            $device->status = 'success';
            if(!empty($detail->stamp)) {
                $stamp = Carbon::parse($detail->stamp);
                $days = $stamp->diffInDays(Carbon::now());

                if($days > 1) {
                    $device->status = 'danger';
                } elseif($days <= 1 && $days <> 0) {
                    $device->status = 'warning';
                }
            }
        });

        return $devices;
    }
}
