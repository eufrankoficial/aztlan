<?php

namespace App\Services\System;

use App\Models\Device;
use App\Models\Field;
use App\Repositories\System\FieldRepository;
use Illuminate\Support\Facades\DB;

class FieldService
{
    /**
     * @var FieldRepository.
     */
    protected $fieldRepo;

    public function __construct(FieldRepository $fieldRepo)
    {
        $this->fieldRepo = $fieldRepo;
    }

    public function prepareFieldsAndSave(array $fieldsAndValues, Device $device)
    {
        $fields = collect($fieldsAndValues);
		$deviceFields = $device->fields->pluck('field')->toArray();
		$values = [];

        foreach($fields as $field => $value) {
            $fieldInstance = $field;
            $existField = in_array($fieldInstance, $deviceFields);
            $createNewField = !$existField ? true : false;

            if(!$createNewField) {
				$fieldInstance = $this->returnFieldInstance($device->fields, $fieldInstance)->first();
				$values[] = [
					'field_id' => $fieldInstance->id,
					'value' => $value,
					'slug' => $value,
					'created_at' => $fieldsAndValues['stamp'],
					'updated_at' => $fieldsAndValues['stamp']
				];
			} else {
				try {
					DB::beginTransaction();
					$savedField = $this->saveFieldAndValue($fieldInstance, $value, $createNewField, $fieldsAndValues['stamp']);
					$this->fieldRepo->syncFields($device, $savedField);
					DB::commit();
				} catch(\Exception $e) {
					DB::rollback();
				}

			}
        }

		return $values;
    }

    private function returnFieldInstance($deviceFields, $fieldString)
	{
		return $deviceFields->filter(function($field) use ($fieldString){
			return $field->field == $fieldString;
		});
	}

    private function saveFieldAndValue($field, $value, $createField = true, $stampToValue = false): Field
    {
        return $this->fieldRepo->saveField($field, $value, $createField, $stampToValue);
    }
}
