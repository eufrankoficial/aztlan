<?php

namespace App\ViewModels;

use App\Models\GroupUser;
use Spatie\ViewModels\ViewModel;
use App\Repositories\System\PermissionRepository;

class EditUserGroupViewModel extends ViewModel
{
    public function __construct(GroupUser $groupUser, PermissionRepository $permissionRepository)
    {
		$this->groupUser = $groupUser;
		$this->groupUser->load(['permissions', 'menus']);
		$this->permissionRepository = $permissionRepository;
	}

	function group()
	{
		return $this->groupUser;
	}

	function permissions()
	{
		return $this->permissionRepository->get();
	}

	function groupPermissions()
	{
		return $this->groupUser->permissions->pluck('slug')->toArray();
	}
}
