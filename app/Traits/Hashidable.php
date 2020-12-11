<?php

namespace App\Traits;
use Hashids\Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        return Hashids::connection('main')->encode($this->getKey());
    }

    public function getPublicIdAttribute()
    {
        $hashId = new Hashids();
        return $this->attributes['id'];
        //return $hashId->encode($this->attributes['id']);
    }

    /**
     * Retrieve the model for a bound value.
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $hashid = new Hashids();
        // $id = $hashid->decode($value);
        $id = $value;
        return $this->where('id', $id)->firstOrFail();
    }
}
