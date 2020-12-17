<?php

namespace App\Repositories\System;
use App\Models\Field;
use App\Repositories\BaseRepository;

class FieldRepository extends BaseRepository
{
    protected $modelClass = Field::class;

    public function saveField($field, $value): Field
    {
        $field = $this->create([
            'field' => $field,
            'list_name' => $field,
            'form_name' => $field,
            'report_name' => $field
        ]);

        $field->value()->create([
            'value' => $value
        ]);

        return $field;
    }
}
