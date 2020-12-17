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

    public function prepareFieldsAndSave(array $fieldsAndValues)
    {
        $fields = collect($fieldsAndValues);
        $createdFields = [];

        $fields->map(function ($field) use (&$createdFields){
            foreach($field as $key => $value) {
                $createdFields[] = $this->saveFieldAndValue($key, $value);
            }
        });

        return $createdFields;
    }

    private function saveFieldAndValue($field, $value): Field
    {
        return $this->fieldRepo->saveField($field, $value);
    }
}
