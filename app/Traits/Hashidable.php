<?php

namespace App\Traits;
use Hashids\Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        return $this->getKey();
    }

    public function getPublicIdAttribute()
    {
        return $this->attributes['id'];
    }

    /**
     * Retrieve the model for a bound value.
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->firstOrFail();
    }
}
