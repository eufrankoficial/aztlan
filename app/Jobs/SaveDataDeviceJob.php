<?php

namespace App\Jobs;

use App\Services\Device\SyncDevicesDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SaveDataDeviceJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $deviceData;
    private $syncDeviceData;

    /**
     * Create a new job instance.
     *
     * @param mixed $deviceData
     */
    public function __construct($deviceData)
    {
        $this->deviceData = $deviceData;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $syncDeviceData = new SyncDevicesDataService($this->deviceData);
            $syncDeviceData->init();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
