<?php

namespace App\Services\Device;

use App\Models\Device;
use App\Repositories\Device\DeviceRepository;

class DeviceChartService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
	}


	public function saveChartConfig(Device $device, array $config)
	{
		$axes = [
			'x' => $config['x'],
			'y' => $config['y']
		];

		$deviceChartConfig = [];

		foreach($axes as $key => $field) {
			$deviceChartConfig[] = [
				'chart_type_id' => $config['chart_type_id'],
				'field_id' => $field,
				$key => 1
			];
		}

		$detaching = isset($config['detaching']) ? true : false;

		return $this->deviceRepo->syncChartConfig(
			$device,
			$deviceChartConfig,
			$detaching
		);
	}

}
