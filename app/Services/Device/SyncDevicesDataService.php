<?php

namespace App\Services\Device;

use App\Models\Device;
use App\Services\System\FieldService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\FieldValue;

class SyncDevicesDataService
{
	protected $fieldRepo;

    public function __construct($data)
    {
        $this->data = $data;
        $this->fieldService = App::make(FieldService::class);
    }

    public function init()
    {
        $this->saveDevice();
    }

    public function saveDevice()
    {
        $devicesToUpdateOrSave = [];
        $codeIds = [];
        $deviceDataFields = [];
		$idsToDelete = [];
        foreach ($this->data as $device) {
			$idsToDelete[] = $device->id;
            $deviceData = json_decode($device->data);
            $devicesToUpdateOrSave[] = [
                'code_device' => $deviceData->id,
            ];
            $codeIds[] = $deviceData->id;

            $deviceDataFields[$deviceData->id][] = $deviceData;
        }


		Device::upsert($devicesToUpdateOrSave, ['code_device']);

		$devicesList = Device::with(['fields.values'])->whereIn('code_device', $codeIds)->get();

		$inserts = [];
		$this->data->map(function($dev) use ($devicesList, &$inserts) {
			$list = $devicesList->filter(function ($d) use ($dev) {
                return $d->code_device == $dev->device_code;
            });

			$list->map(function ($d) use ($dev, &$inserts) {
				$inserts[] = $this->fieldService->prepareFieldsAndSave((array)json_decode($dev->data), $d);
            });
		});

		$all = [];
		foreach($inserts as $insert) {
			foreach(array_filter($insert) as $in) {
				$all[] = array_filter($in);
			}
		}

		DB::table('field_value')->insert($all);
		DB::table('device_tmp')->whereIn('id', $idsToDelete)->delete();
    }
}
