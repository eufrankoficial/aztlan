<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceDetail extends BaseModel
{
    use HasFactory, Searchable, Hashidable, SoftDeletes;

    protected $table = 'device_detail';
    protected $fillable = [
        'device_id',
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
        'created_at',
        'updated_at',
        'deleted_at',
        'stamp'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }

    public function getStatusAttribute(): string
    {
        $stamp = Carbon::parse($this->attributes['stamp']);
        $days = $stamp->diffInDays(Carbon::now());
        $status = 'success';

        if($days > 1) {
            $status = 'danger';
        } elseif($days <= 1 && $days <> 0) {
            $status = 'warning';
        }

        return $status;
    }
}
