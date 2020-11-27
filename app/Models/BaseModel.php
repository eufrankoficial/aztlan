<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BaseModel.
 * @package App\Models.
 */
abstract class BaseModel extends Model
{
    use SoftDeletes;

    protected $keyName = false;

    /**
     * On creating, updating and deleting Model.
     */
    protected static function boot()
    {
        parent::boot();

        if(current_user()) {
            self::creating(function($model) {
                $model->created_by = current_user()->id;
                $model->updated_by = current_user()->id;
            });

            self::updating(function($model) {
                $model->updated_by = current_user()->id;
            });
        }
    }

    /**
     * @param Builder $builder
     * @return Builder
     * @throws \Exception.
     */
    public function scopeFilter(Builder $builder, $request)
    {
        if($request->query->count() > 0)
            $builder = $this->search($builder, $request);

        return $builder;
    }

}
