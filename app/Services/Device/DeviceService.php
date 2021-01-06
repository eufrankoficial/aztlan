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
		// Eixo x do dispositivo
        $fieldToChart = $device->charts()->where('x', 1)->first();

		// pegar todos os valores desse campos
		$fieldAxe = $device->fields()
			->with(['values'])
			->whereHas('values', function($query) {
				$query->orderBy('created_at', 'asc');
			})->where('field_id', $fieldToChart->pivot->field_id)
			->first();

		$dataLabels = $fieldAxe->values->pluck('value')->toArray();
		$fields = $device->fields()->with('values')->whereNotIn('field', [$fieldAxe->field])->get();


        $sets = [];
        foreach($fields as $key => $field) {
            if($field->field !== $fieldAxe->field) {
                $sets[] = [
                    'label' => $field->field,
                    'backgroundColor' => '#D51058',
                    'data' => $field->values->pluck('value')->toArray()
                ];
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
            $detail = $device->detail;
            $device->status = 'success';
            if(!empty($detail->stamp)) {
                $stamp = Carbon::parse($detail->stamp);
                $days = $stamp->diffInDays(Carbon::now());

                if($days > 1) {
                    $device->status = 'danger';
                } elseif($days <= 1 && $days <> 0) {
                    $device->status = 'warning';
                }
                $device->stamp_view = $stamp->diffForHumans();
            }
        });

        return $devices;
    }
}
