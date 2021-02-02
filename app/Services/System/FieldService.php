<?php

namespace App\Services\System;

use App\Models\Device;
use App\Models\Field;
use App\Repositories\System\FieldRepository;

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

    public function prepareFieldsAndSave(array $fieldsAndValues, Device $device): void
    {
        $fields = collect($fieldsAndValues);
		$deviceFields = $device->fields->pluck('field')->toArray();

        foreach($fields as $field => $value) {
            $fieldInstance = $field;

            $existField = in_array($fieldInstance, $deviceFields);
            $createNewField = !$existField ? true : false;

            if(!$createNewField) {
				$fieldInstance = $this->returnFieldInstance($device->fields, $fieldInstance)->first();
			}

            $savedField = $this->saveFieldAndValue($fieldInstance, $value, $createNewField, $fieldsAndValues['stamp']);
            if($createNewField)
            	$this->fieldRepo->syncFields($device, $savedField);
        }
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
