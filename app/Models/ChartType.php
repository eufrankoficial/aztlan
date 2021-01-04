<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class ChartType extends BaseModel
{
    use SoftDeletes;
    use HasSlug;

    protected $table = 'chart_type';

    protected $keyName = 'slug';

    protected $fillable = [
        'type',
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

    protected $sourceSlug = 'type';
}
