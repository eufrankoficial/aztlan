<?php

namespace App\ViewModels;

use App\Repositories\System\MenuRepository;
use App\Repositories\System\PermissionRepository;
use Spatie\ViewModels\ViewModel;

class CreateUserGroupViewModel extends ViewModel
{

    public function __construct(PermissionRepository $permissionRepository, MenuRepository $menuRepository)
    {
		$this->permissionRepository = $permissionRepository;
		$this->menuRepository = $menuRepository;
	}

	function permissions()
	{
		return $this->permissionRepository->get();
	}

	function menus()
	{
		return $this->menuRepository
			->with(['parents'])->get();
	}
}
