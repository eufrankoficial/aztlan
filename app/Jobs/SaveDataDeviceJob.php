<?php

namespace App\Jobs;

use App\Services\Device\DeviceService;
use App\Services\System\FieldService;
use App\Services\System\JobService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaveDataDeviceJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $deviceData;
    private $deviceService;
    private $fieldService;
    private $jobService;

    /**
     * Create a new job instance.
     */
    public function __construct(array $deviceData)
    {
        $this->deviceData = $deviceData;
        $this->deviceService = app(DeviceService::class);
        $this->fieldService = app(FieldService::class);
        $this->jobService = app(JobService::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $device = $this->deviceService->save([
                'code_device' => $this->deviceData['id'],
            ]);
            $this->fieldService->prepareFieldsAndSave($this->deviceData, $device);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Log::error('Error on job: . '.json_encode($this->deviceData));
            $this->jobService->createJobOnQueue($this->deviceData);
        }
    }
}
