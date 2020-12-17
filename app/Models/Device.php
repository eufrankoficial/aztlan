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

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'device_field', 'device_id', 'field_id', 'field_value_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
