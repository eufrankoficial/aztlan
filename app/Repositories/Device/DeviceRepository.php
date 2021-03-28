<?php

namespace App\Repositories\Device;

use App\Models\Device;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DeviceRepository extends BaseRepository
{
	protected $modelClass = Device::class;

	public function syncChartConfig(Device $device, array $config, $detaching = false)
	{
		return $device->charts()->sync($config, $detaching);
	}

	public function createOrUpdate(array $data, $device = null): Device
	{
		return DB::transaction(function() use ($data, &$model) {
			$device = $this->with(['fields'])
                    ->where('code_device', trim($data['code_device']))
					->first();

			return !$device ? $this->create($data) : $this->update($device->id, $data);
		});
	}
}
