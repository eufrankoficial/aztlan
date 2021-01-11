<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class GroupUser extends Role
{
    use Searchable, HasSlug;

    /**
     * @var string.
     */
    protected $sourceSlug = 'name';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var array
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'permissions' => [
            'permissions.slug' => 'in'
        ],
        'menus' => [
            'menus.slug' => 'in'
        ]
    ];

    const SUPER_ADMIN = 1;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_role', 'role_id', 'menu_id');
	}

    /**
     * @param Builder $builder
     * @param $slug
     * @return Builder.
     */
    public function scopeSlug(Builder $builder, $slug)
    {
        return $builder->where('slug', $slug);
    }

    /**
     * @param Builder $builder
     * @return Builder
     * @throws \Exception
     */
    public function scopeFilter(Builder $builder, Request $request)
    {
        if($request->query->count() > 0) {
            $builder = $this->search($builder, $request);
        }

		return $builder;

    }

  	/**
     * @return string
     */
    public function getRouteKeyName()
    {
        if($this->keyName)
            return $this->keyName;

        return 'id';
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
