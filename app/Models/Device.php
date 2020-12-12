<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use Hashidable;
    use Searchable;

    protected $table = 'device';
    protected $fillable = [
        'vehicle_id',
        'code_device',
        'description'
    ];

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'description' => 'like',
        'code_device' => '=',
        'history' => [
            'stamp' => 'betweeen'
        ]
    ];

    protected $dates = [
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

    public function detail()
    {
        return $this->hasOne(DeviceDetail::class, 'device_id', 'id')->orderBy('stamp', 'desc');
    }

    public function history()
    {
        return $this->hasMany(DeviceDetail::class, 'device_id', 'id')->orderBy('stamp', 'asc');
    }

    public function getStatusAttribute()
    {
        return $this->getStatus();
    }

    public function getStatus()
    {
        $stamp = Carbon::parse($this->detail->stamp);
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
