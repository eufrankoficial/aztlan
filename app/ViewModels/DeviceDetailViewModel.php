<?php

namespace App\ViewModels;

use App\Models\Device;
use App\Models\Type;
use App\Services\Device\DeviceService;
use Spatie\ViewModels\ViewModel;
use App\Enums\ChartTypeEnum;
use Carbon\Carbon;

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
        $this->device->load(['fields.type', 'fields.value', 'charts']);
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

	public function status()
	{
		$status = [
			'class' => 'success',
			'name' => 'Online'
		];

		$now = now();
		$updated = $now->diffInDays($this->device->updated_at_status ?: $this->device->created_at);

		if($updated == 1) {
			$status = [
				'class' => 'warning',
				'name' => 'Aguardando...'
			];
		} elseif($updated > 1) {
			$status = [
				'class' => 'danger',
				'name' => 'Offline'
			];
		}

		return json_encode($status);
	}

	public function typeFields()
	{
		return Type::orderBy('type', 'asc')->get();
	}
}
