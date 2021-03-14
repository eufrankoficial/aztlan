<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceTmp extends Model
{
    protected $table = 'device_tmp';

    protected $fillable = [
        'device_code',
        'data',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
