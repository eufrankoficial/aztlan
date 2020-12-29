<?php

namespace App\Services\System;

use App\Models\Device;
use App\Models\Field;
use App\Repositories\Device\DeviceRepository;
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

    public function prepareFieldsAndSave(array $fieldsAndValues, Device $device)
    {
        $fields = collect($fieldsAndValues);

        foreach($fields as $field => $value) {
            $fieldInstance = $field;
            $existField = $device->fields->filter(function($deviceField) use ($field) {
                return $deviceField->field === $field;
            });

            if($existField->count() > 0) {
                $fieldInstance = $existField->first();
            }

            $savedField = $this->saveFieldAndValue($fieldInstance, $value);

            if($existField->count() === 0)
                $this->fieldRepo->syncFields($device, $savedField);

        }
    }

    private function saveFieldAndValue($field, $value): Field
    {
        $createField = $field instanceof Field ? false : true;
        return $this->fieldRepo->saveField($field, $value, $createField);
    }
}
