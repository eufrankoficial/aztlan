<?php

namespace App\Repositories\Device;

use App\Models\Device;
use App\Repositories\BaseRepository;

class DeviceRepository extends BaseRepository
{
	protected $modelClass = Device::class;

	public function syncChartConfig(Device $device, array $config, $detaching = false)
	{
		return $device->charts()->sync($config, $detaching);
	}
}
