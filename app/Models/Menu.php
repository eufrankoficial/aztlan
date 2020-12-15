<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends BaseModel
{
    protected $table = 'menu';

    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function parents()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }
}
