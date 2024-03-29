<?php

namespace App\Services\Device;

use App\Enums\FieldTypeEnum;
use App\Formats\GiveMeTheFormatClass;
use App\Models\Device;
use App\Models\Field;
use App\Repositories\Device\DeviceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function updateField($data, Field $field)
    {
        return $field->update($data);
    }

    public function save(array $data)
    {
        return $this->deviceRepo->createOrUpdate($data);
    }

    public function update(array $data, $device)
    {
        $device = $this->deviceRepo->update($device->id, $data);

        return $device;
    }

    public function show($device, $request)
    {
        $device->stamp_view = $device->created_at;
        $this->formatDeviceFieldValues($device, $request);
        return $device;
    }

    public function formatDeviceFieldValues(&$device)
	{
		$device->fields->map(function($field) use (&$device) {
			$typeId = $field->type_id;
			$value = $field->value->value;
			$formatted = new GiveMeTheFormatClass($typeId, [
				'value' => $value
			]);

			$field->formatted_value = $formatted->getValue();
			$field->value->formatted_value = $formatted->getValue();
			if($field->type_id === FieldTypeEnum::LATITUDE) {
				$device->lat = $formatted->getValue();
			}

			if($field->type_id === FieldTypeEnum::LONGITUDE) {
				$device->lon = $formatted->getValue();
			}
		});
	}

    public function getDeviceList(): ?LengthAwarePaginator
    {
        $devices = $this->deviceRepo->model()->filter(request())
			->orderBy('updated_at', 'DESC')->paginate(30);

        $devices->map(function(&$device) {
			$now = now();
			$updated = $now->diffInDays($device->getUpdatedAtStatus() ?: $device->created_at);

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
