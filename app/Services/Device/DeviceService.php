<?php

namespace App\Services\Device;

use App\Models\Device;
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

    public function saveFields(Device $device, $deviceFields)
    {
        foreach($deviceFields as $field) {
            $device->fields()->sync([
                'field_id' => $field->id,
                'field_value_id' => $field->value->id
            ], false);
        }
    }

    public function list(Request $request)
    {

    }

    public function create(array $data)
    {
        $device = $this->deviceRepo->where('code_device', $data['code_device'])->first();
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
        /*
        $stamps = $device->history->pluck('stamp')->toArray();
        $dataLabels = [];
        foreach($stamps as $stamp) {
            $dataLabels[] = $stamp->format('d/m/Y H:i');
        }

        $toChart = [
            'bat' => '#84C7C7',
            'temp' => '#D51058',
            'umi' => '#CB1EA1',
            'cnt' => '#ECEC12',
            'co2' => '#398703',
            'tempdht1' => '#578677',
            'tempdht2' => '#0C5389'
        ];

        $sets = [];
        foreach($toChart as $chart => $color) {
            $sets[] = [
                'label' => $chart,
                'backgroundColor' => $color,
                'data' => $device->history->pluck($chart)->toArray()
            ];

        }

        return collect([
            'labels' => $dataLabels,
            'sets' => $sets
        ]);*/
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
