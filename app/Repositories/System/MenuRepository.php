<?php

namespace App\Repositories\System;

use App\Models\Menu;
use App\Repositories\BaseRepository;

class MenuRepository extends BaseRepository
{
    protected $modelClass = Menu::class;

    /**
     * @param Menu $menu.
     * @param $parents.
     */
    public function saveParents(Menu $menu, $parents)
    {
        $parents = $this->whereIn('slug', $parents)->get();

        $parents->map(function($parent) use ($menu) {
            $parent->parent_id = $menu->id;
            $parent->save();
        });
    }
}
