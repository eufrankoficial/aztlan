<?php

namespace App\Models;

use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use Hashidable;

    protected $table = 'device';
    protected $fillable = [
        'vehicle_id',
        'code_device',
        'description',
        'lon',
        'lat',
        'bat',
        'temp',
        'umi',
        'cnt',
        'co2',
        'tempdht1',
        'tempdht2',
        'stamp',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'stamp',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
