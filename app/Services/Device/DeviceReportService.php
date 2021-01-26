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
		$initialDate = Carbon::parse($initialDate);
		if($request->get('initialTime')) {
			$time = extractHourAndMinutesFromTime($request->get('initialTime'));
			$initialDate->addHour($time['hour']);
			$initialDate->addMinute($time['minutes']);
		}
		$finalDate = $request->get('finalDate');
		$finalDate = Carbon::parse($finalDate);
		if($request->get('finalTime')) {
			$finalTime = extractHourAndMinutesFromTime($request->get('finalTime'));
			$finalDate->addHour($finalTime['hour']);
			$finalDate->addMinute($finalTime['minutes']);
		}

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
