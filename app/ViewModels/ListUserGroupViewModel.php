<?php

namespace App\ViewModels;

use App\Repositories\System\UserGroupRepository;
use Spatie\ViewModels\ViewModel;

class ListUserGroupViewModel extends ViewModel
{
	protected $userGroupRepository;

    public function __construct(UserGroupRepository $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
	}

	public function groups()
	{
		return $this->userGroupRepository->model()->filter(request())->paginate();
	}
}
