<?php

namespace App\Repositories\System;

use App\Models\GroupUser;
use App\Repositories\BaseRepository;

class UserGroupRepository extends BaseRepository
{
	protected $modelClass = GroupUser::class;


	public function save(array $data, $id = null)
	{
		if(!empty($id)) {
			return $this->update($id, $data);
		}

		return $this->create($data);
	}

	/**
     * Sync permissions to role.
     * @param Role $role
     * @param array $permissions
     * @return Role
     */
    public function syncPermissions(GroupUser $role, array $permissions)
    {
        $role->syncPermissions($permissions);

        return $role;
    }

    /**
     * Sync a group user.
     * @param GroupUser $role
     * @param array $menus
     * @return array
     */
    public function syncMenus(GroupUser $role, array $menus)
    {
        return $role->menus()->sync($menus);
    }
}
