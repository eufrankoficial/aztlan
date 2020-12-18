<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Device extends BaseModel
{
    use SoftDeletes;
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
        'code_device' => '='
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $keyName = 'code_device';

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'device_field', 'device_id', '');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['updated_at']))->format('d/m/Y H:i');
    }
}
