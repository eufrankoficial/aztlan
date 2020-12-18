<?php

namespace App\Models;

use App\Traits\Searchable;
use Spatie\Sluggable\HasSlug;

class Field extends BaseModel
{
    use HasSlug, Searchable;

    protected $table = 'field';
    protected $fillable = [
        'company_id',
        'type_id',
        'field',
        'list_name',
        'form_name',
        'report_name',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $keyName = 'slug';
    protected $sourceSlug = 'field';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'type_id', 'id');
    }

    public function value()
    {
        return $this->hasOne(FieldValue::class, 'field_id', 'id');
    }
}