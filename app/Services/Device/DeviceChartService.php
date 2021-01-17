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
		if(count($config) == 0) {
			$this->deviceRepo->syncChartConfig(
				$device,
				[],
				true
			);
		} else {
			foreach($config as $conf) {
				$axes = [
					'x' => $conf['x'],
					'y' => $conf['y']
				];

				$deviceChartConfig = [];

				foreach($axes as $key => $field) {
					if(!empty($field)) {
						$deviceChartConfig[] = [
							'chart_type_id' => $conf['chart_type_id'],
							'field_id' => $field,
							$key => 1
						];
					}
				}

				$detaching = isset($conf['detaching']) ? true : false;

				$this->deviceRepo->syncChartConfig(
					$device,
					$deviceChartConfig,
					$detaching
				);
			}
		}

		$device->load(['charts']);

		return $device;
	}

}
