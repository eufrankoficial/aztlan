<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends BaseModel
{
    use SoftDeletes;
    use Searchable;

    protected $table = 'device';
    protected $fillable = [
		'company_id',
        'vehicle_id',
        'code_device',
        'description',
    ];

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'description' => 'like',
        'code_device' => '=',
		'company_id' => '='
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $keyName = 'code_device';

	public function company()
	{
		return $this->belongsTo(Company::class, 'company_id', 'id');
	}

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'device_field', 'device_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function charts()
    {
        return $this->belongsToMany(ChartType::class, 'device_chart_type', 'device_id', 'chart_type_id')->withPivot(['x', 'y', 'field_id']);
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['updated_at']))->diffForHumans();
	}

	public function getUpdatedAtStatus()
	{
		return $this->attributes['updated_at'];
	}
}
