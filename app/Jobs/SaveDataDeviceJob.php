<?php

namespace App\Jobs;

use App\Services\Device\DeviceService;
use App\Services\System\FieldService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SaveDataDeviceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $deviceData;
    private $deviceService;
    private $fieldService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $deviceData)
    {
        $this->deviceData = $deviceData;
		$this->deviceService = app(DeviceService::class);
		$this->fieldService = app(FieldService::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	try {
    		DB::beginTransaction();
			$device = $this->deviceService->save([
				'code_device' => $this->deviceData['id']
			]);
			$this->fieldService->prepareFieldsAndSave($this->deviceData, $device);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage());
    		Log::error('Error on job: . ' . json_encode($this->deviceData));
		}
    }
}
