<?php

namespace App\ViewModels;

use App\Repositories\System\PermissionRepository;
use Spatie\ViewModels\ViewModel;

class CreateUserGroupViewModel extends ViewModel
{

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
	}

	function permissions()
	{
		return $this->permissionRepository->get();
	}
}
