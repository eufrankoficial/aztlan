<?php

namespace App\Services\Device;

use App\Enums\ChartTypeEnum;
use App\Enums\TrueOrFalseEnum;
use App\Models\Device;
use App\Repositories\Device\DeviceRepository;
use Carbon\Carbon;

class DeviceChartService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }


	public function saveChartConfig(Device $device, array $config)
    {
        if (0 == count($config)) {
            $this->deviceRepo->syncChartConfig(
                $device,
                [],
                true
            );
        } else {
            foreach ($config as $conf) {
                $axes = [
                    'x' => $conf['x'],
                    'y' => $conf['y']
                ];

                $deviceChartConfig = [];

                foreach ($axes as $key => $field) {
                    if (!empty($field)) {
                        $deviceChartConfig[] = [
                            'chart_type_id' => $conf['chart_type_id'],
                            'field_id' => $field,
                            $key => 1,
                        ];
                    }
                }

                $detaching = isset($conf['detaching']) ? true : false;

                $this->deviceRepo->syncChartConfig(
                    $device,
                    $deviceChartConfig,
                    $detaching
                );
            }
        }

        $device->load(['charts']);

        return $device;
    }

    public function getDataChart($device, $request)
    {
        return $this->chart($device, $request);
    }

    private function chart(Device $device, $request)
    {
        $dataLabels = [];
        $sets = [];

        // Eixo x do dispositivo
        $fieldToChart = $this->returnCharType($device);
        $fieldToChart = $fieldToChart->first();
        $initialDate = $request->get('initialDate');
        $initialDate = !empty($initialDate) ? Carbon::createFromFormat('d/m/Y H:i', $initialDate) : now()->startOfHour();
        $finalDate = $request->get('finalDate');
        $finalDate = !empty($finalDate) ? Carbon::createFromFormat('d/m/Y H:i', $finalDate) : now()->endOfHour();

        if (!empty($fieldToChart->pivot)) {
            // pegar todos os valores desse campo
            $xValues = $this->returnXaxeValues($device, $fieldToChart->pivot, $initialDate, $finalDate);
            $dataLabels = $xValues['dataLabels'];
            $fieldAxe = $xValues['fieldAxe'];

            $fields = $device->fields->filter(function ($field) use ($fieldAxe) {
                return $field->field !== $fieldAxe->field && TrueOrFalseEnum::TRUE == $field->show_on_chart;
            });

            $sets = $this->returnSetValeusYAxe($fields, $fieldAxe, $initialDate, $finalDate);
        }

        return collect([
            'labels' => $dataLabels,
            'sets' => $sets,
        ]);
    }

    private function returnSetValeusYAxe($fields, $fieldAxe, $initialDate, $finalDate)
    {
        $sets = [];
        foreach ($fields as $key => $field) {
            if ($field->field !== $fieldAxe->field) {
                $values = $field->values->filter(function ($value) use ($initialDate, $finalDate) {
                    return $value->created_at->between($initialDate->format('Y-m-d H:i'), $finalDate->format('Y-m-d H:i'));
                });

                $sets[] = [
                    'label' => $field->list_name,
                    'backgroundColor' => 'rgba('.hexToRgb($field->color_on_chart).', 0.1)',
                    'borderColor' => 'rgba('.hexToRgb($field->color_on_chart).', 0.5)',
                    'data' => $values->pluck('value')->toArray(),
                ];
            }
        }

        return $sets;
    }

    private function returnXaxeValues($device, $pivot, $initialDate, $finalDate)
    {
        $pivotId = $pivot->field_id;
        $fieldAxe = $device->fields->filter(function ($field) use ($pivotId) {
            return $field->id === $pivotId;
        })->first();

        $dataLabels = $fieldAxe->values()->whereBetween('created_at', [
            $initialDate->format('Y-m-d H:i'),
            $finalDate->format('Y-m-d H:i'),
        ])->get();

        return [
            'dataLabels' => $dataLabels->pluck('formatted_value')->toArray(),
            'fieldAxe' => $fieldAxe,
        ];
    }

    private function returnCharType(Device $device)
    {
        return $device->charts->filter(function ($chart) {
            return ChartTypeEnum::LINE == $chart->id;
        });
    }
}
