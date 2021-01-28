<?php

namespace App\Services\System;

use App\Jobs\SaveDataDeviceJob;

class JobService
{
	public function createJobOnQueue(array $data)
	{
		SaveDataDeviceJob::dispatch($data);
	}
}
