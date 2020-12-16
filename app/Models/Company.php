<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Company extends BaseModel
{
    use SoftDeletes, HasSlug, Searchable;

    protected $table = 'company';
    protected $fillable = [
        'company_name',
        'fantasy_name',
        'cpf_cnpj',
        'logo',
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
    protected $sourceSlug = 'company_name';

}
