<?php

namespace App\Repositories\System;
use App\Models\Device;
use App\Models\Field;
use App\Repositories\BaseRepository;

class FieldRepository extends BaseRepository
{
    protected $modelClass = Field::class;

    public function saveField($field, $value, $createField = true, $stamp = false): Field
    {
        if($createField) {
            $field = $this->create([
                'field' => $field,
                'list_name' => $field,
                'form_name' => $field,
                'report_name' => $field
            ]);
        }

        $field->values()->create([
            'value' => $value,
			'created_at' => $stamp,
			'updated_at' => $stamp
        ]);

        return $field;
    }

    public function syncFields(Device $device, $field, $detaching = false): void
    {
        $device->fields()->sync([
            'field_id' => $field->id
        ], $detaching);
    }
}
