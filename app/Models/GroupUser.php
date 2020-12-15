<?php

namespace App\Models;

use App\Traits\Searchable;
use Spatie\Permission\Models\Role;

class GroupUser extends Role
{
    use Searchable;

    /**
     * @var string.
     */
    protected $source = 'name';

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
}
