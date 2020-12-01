<?php

namespace App\Models;

use App\Traits\Hashidable;
use Carbon\Carbon;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
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
