<?php


namespace App\Services\Device;


use App\Enums\ChartTypeEnum;
use App\Enums\TrueOrFalseEnum;
use App\Models\Device;
use App\Repositories\Device\DeviceRepository;
use Carbon\Carbon;

class DeviceReportService
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function exportDetail(Device $device, $request)
    {
		$data = $this->report($device, $request);
		$report = $this->extractFieldsAndValues($data['device']);

		return [
			'report' => $report,
			'data' => $data
		];
    }

    private function extractFieldsAndValues($device)
	{
		$fields = $device->fields;
		$lines = [];
		foreach($device->fields as $field) {
			if(!empty($field->report_values)) {
				foreach($field->report_values as $key => $value) {
					$lines[$key+1][$field->field] = $value->formatted_value;
				}
			}
		}

		return [
			'fields' => $fields,
			'lines' => $lines
		];
	}

	private function report(Device $device, $request)
	{
		$initialDate = $request->get('initialDate');
		if(!is_null($request->get('initialTime'))) {
			$time = extractHourAndMinutesFromTime($request->get('initialTime'));
			$initialDate = $initialDate . ' '. (int)$time['hour'] . ':' . $time['minutes'];
		} else {
			$initialDate = $initialDate . ' 00:00';
		}

		$initialDate = Carbon::createFromFormat('d/m/Y H:i', $initialDate);

		$finalDate = $request->get('finalDate');
		if(!is_null($request->get('finalTime'))) {
			$finalTime = extractHourAndMinutesFromTime($request->get('finalTime'));
			$finalDate = $finalDate . ' '. (int)$finalTime['hour'] . ':' . $finalTime['minutes'];
		} else {
			$finalDate = $finalDate . ' 23:59';
		}

		$finalDate = Carbon::createFromFormat('d/m/Y H:i', $finalDate);
		$device->fields->map(function($field) use ($initialDate, $finalDate) {
			if($field->show_on_report) {
				$field->report_values = $field->values->filter(function($value) use ($initialDate, $finalDate) {
					return $value->created_at->between($initialDate->format('Y-m-d H:i'), $finalDate->format('Y-m-d H:i'));
				});
			}
		});

		return [
			'device' => $device,
			'initialDate' => $initialDate,
			'finalDate' => $finalDate
		];
	}
}
