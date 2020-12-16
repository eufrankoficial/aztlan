<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;

class Menu extends BaseModel
{
    use HasFactory, HasSlug;

    protected $table = 'menu';
    protected $fillable = [
        'menu',
        'route',
        'parent_id',
        'icon',
        'order',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $keyName = 'slug';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function parents()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }
}
