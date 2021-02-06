<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;

/**
 * Class BaseModel.
 * @package App\Models.
 */
abstract class BaseModel extends Model
{
    use SoftDeletes;

    protected $keyName = false;
    protected $sourceSlug = false;

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

		if(current_user()->hasRole('SuperAdmin'))
			return $builder;

		$dataFilter = company();

		if($builder->getModel() instanceof Device) {
            $builder->where('company_id', $dataFilter->id);
        } elseif($builder->getModel() instanceof Company) {
			$builder->where('id', $dataFilter->id);
		} else {
            $builder->whereHas('company', function($query) use ($dataFilter) {
                $id = isset($dataFilter->id) ? $dataFilter->id : 0;
                $query->where('company.id', $id);
            });
        }

        return $builder;
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->sourceSlug)
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        if($this->keyName)
            return $this->keyName;

        return 'id';
    }

}
