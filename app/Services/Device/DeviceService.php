<?php

namespace App\Services\Device;

use App\Enums\ChartTypeEnum;
use App\Enums\TrueOrFalseEnum;
use App\Formats\GiveMeTheFormatClass;
use App\Models\Device;
use App\Models\Field;
use App\Repositories\Device\DeviceRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class DeviceService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function getFieldsDevice(Device $device)
    {
        return $this->deviceRepo->model()->with([
			'fields.value'
        ])->where('id', $device->id)->first();
    }

    public function saveFields(Device $device, $deviceFields)
    {

    }

    public function updateField($data, Field $field)
    {
        return $field->update($data);
    }

    public function list(Request $request)
    {

    }

    public function save(array $data)
    {
        $device = $this->deviceRepo
                    ->with(['fields'])
                    ->where('code_device', $data['code_device'])->first();

        if(!$device)
            $model = $this->deviceRepo->create($data);
        else
            $model = $this->deviceRepo->update($device->id, $data);

        return $model;
    }

    public function update(array $data, $device)
    {
        $device = $this->deviceRepo->update($device->id, $data['device']);
        $device->detail()->create($data['detail']);

        return $device;
    }

    public function delete($user)
    {

    }

    public function show($device, $request)
    {
        $device->stamp_view = $device->created_at;
        $this->formatDeviceFieldValues($device, $request);
        return $device;
    }

    public function formatDeviceFieldValues(&$device, $request)
	{
		$device->fields->map(function($field) {
			$typeId = $field->type_id;
			$value = $field->value->value;
			$formatted = new GiveMeTheFormatClass($typeId, [
				'value' => $value
			]);

			$field->formatted_value = $formatted->getValue();
			$field->value->formatted_value = $formatted->getValue();
		});
	}

    public function getDeviceList(): ?LengthAwarePaginator
    {
        $devices = $this->deviceRepo->all(15, true);
        $devices->map(function(&$device) {

			$now = now();
			$updated = $now->diffInDays($device->updated_at_status ?: $device->created_at);

			if($updated == 1) {
				$device->status = 'warning';
			} elseif($updated > 1) {
				$device->status = 'danger';
			} else {
				$device->status = 'success';
			}
        });

        return $devices;
    }
}
