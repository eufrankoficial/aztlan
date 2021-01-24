<?php

namespace App\Models;

use App\Formats\GiveMeTheFormatClass;
use App\Traits\Searchable;
use Spatie\Sluggable\HasSlug;

class FieldValue extends BaseModel
{
    use HasSlug, Searchable;
    protected $table = 'field_value';
    protected $keyName = 'slug';
    protected $sourceSlug = 'value';

	protected $searchableAttrs = [
		'created_at' => 'bettween'
	];

    protected $fillable = [
        'field_id',
        'value',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id', 'id');
    }

    public function getFormattedValueAttribute()
	{
		$formatted = new GiveMeTheFormatClass($this->field->type_id, [
			'value' => $this->attributes['value']
		]);

		return $formatted->getValue();
	}
}
