<?php

namespace App\ViewModels;

use App\Models\GroupUser;
use App\Repositories\System\MenuRepository;
use Spatie\ViewModels\ViewModel;
use App\Repositories\System\PermissionRepository;
use Illuminate\Support\Collection;

class EditUserGroupViewModel extends ViewModel
{
    public function __construct(GroupUser $groupUser, PermissionRepository $permissionRepository, MenuRepository $menuRepository)
    {
		$this->groupUser = $groupUser;
		$this->groupUser->load(['permissions', 'menus']);
		$this->permissionRepository = $permissionRepository;
		$this->menuRepository = $menuRepository;
	}

	function group()
	{
		return $this->groupUser;
	}

	function menusGroup()
	{
		return $this->groupUser->menus->pluck('slug')->toArray();
	}

	/**
     * @return Collection.
     */
    function menus(): Collection
    {
        return $this->menuRepository->with(['parents'])->get();
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
