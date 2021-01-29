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
		if(count($config) == 0) {
			$this->deviceRepo->syncChartConfig(
				$device,
				[],
				true
			);
		} else {
			foreach($config as $conf) {
				$axes = [
					'x' => $conf['x'],
					'y' => $conf['y']
				];

				$deviceChartConfig = [];

				foreach($axes as $key => $field) {
					if(!empty($field)) {
						$deviceChartConfig[] = [
							'chart_type_id' => $conf['chart_type_id'],
							'field_id' => $field,
							$key => 1
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
		$fieldToChart = $device->charts->filter(function($chart) {
			return $chart->id == ChartTypeEnum::LINE;
		});

		$fieldToChart = $fieldToChart->first();

		$initialDate = now()->startOfHour();
		if(!is_null($request->get('initialDate'))) {
			$initialDate = $request->get('initialDate');
			$initialDate = Carbon::parse($initialDate);
		}

		$finalDate = now()->endOfHour();
		if(!is_null($request->get('finalDate'))) {
			$finalDate = $request->get('finalDate');
			$finalDate = Carbon::parse($finalDate);
		}


		if(!empty($fieldToChart->pivot)) {
			// pegar todos os valores desse campo
			$pivotId = $fieldToChart->pivot->field_id;
			$fieldAxe = $device->fields->filter(function($field) use ($pivotId){
				return $field->id === $pivotId;
			})->first();

			$dataLabels = $fieldAxe->values()->whereBetween('value', [
				$initialDate->format('Y-m-d H:i'),
				$finalDate->format('Y-m-d H:i')
			])->get();

			$dataLabels = $dataLabels->pluck('formatted_value')->toArray();

			$fields = $device->fields->filter(function($field) use ($fieldAxe){
				return $field->field !== $fieldAxe->field && $field->show_on_chart == TrueOrFalseEnum::TRUE;
			});

			$sets = [];
			foreach($fields as $key => $field) {
				if($field->field !== $fieldAxe->field) {
					$values = $field->values->filter(function ($value) use ($initialDate, $finalDate){
						return $value->created_at->between($initialDate->format('Y-m-d H:i'), $finalDate->format('Y-m-d H:i'));
					});

					$sets[] = [
						'label' => $field->list_name,
						'backgroundColor' => $field->color_on_chart,
						'data' => $values->pluck('value')->toArray()
					];
				}
			}
		}

		return collect([
			'labels' => $dataLabels,
			'sets' => $sets
		]);
	}

}
