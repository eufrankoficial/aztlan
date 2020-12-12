<?php


namespace App\Services\Device;


use App\Models\Device;
use App\Repositories\Device\DeviceRepository;

class DeviceReportService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function exportDetail(Device $device, $request)
    {
        $report = $this->deviceRepo->model()
            ->where('id', $device->id)
            ->with(
                [
                    'history' => function ($builder) {
                        $builder->orderBy('stamp', 'desc');
                    }
                ]
            )
            ->filter($request)
            ->first();

        return $report;
    }
}
