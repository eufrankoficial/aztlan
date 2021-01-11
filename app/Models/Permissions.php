<?php

namespace App\Models;

use App\Traits\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Sluggable\HasSlug;

class Permissions extends Permission
{
    use HasSlug;

    /**
     * @var string.
     */
    protected $source = 'name';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @return bool|string.
     */
    public function getRouteKeyName()
    {
        return $this->keyName;
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
}
