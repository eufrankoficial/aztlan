<?php

namespace App\Services\Device;

use App\Models\Device;
use App\Models\Field;
use App\Repositories\Device\DeviceRepository;
use App\Services\Interfaces\BaseServiceInterface;
use Carbon\Carbon;
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

    public function show($device)
    {
        $device->stamp_view = $device->created_at;
        $device->status = 'online';

        return $device;
    }

    public function chart(Device $device)
    {
		$dataLabels = [];
		$sets = [];
		// Eixo x do dispositivo
        $fieldToChart = $device->charts()->where('x', 1)->first();

		if(!empty($fieldToChart->pivot)) {
			// pegar todos os valores desse campos
		$fieldAxe = $device->fields()
			->with(['values'])
			->whereHas('values', function($query) {
				$query->orderBy('created_at', 'asc');
			})->where('field_id', $fieldToChart->pivot->field_id)
			->first();

		$dataLabels = $fieldAxe->values->pluck('value')->toArray();
		$fields = $device->fields()->with('values')->whereNotIn('field', [$fieldAxe->field])->where('show_on_chart', 1)->get();

        $sets = [];
        foreach($fields as $key => $field) {
            if($field->field !== $fieldAxe->field) {
                $sets[] = [
                    'label' => $field->list_name,
                    'backgroundColor' => $field->color_on_chart,
                    'data' => $field->values->pluck('value')->toArray()
                ];
            }
        }
		}

        return collect([
            'labels' => $dataLabels,
            'sets' => $sets
        ]);
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
