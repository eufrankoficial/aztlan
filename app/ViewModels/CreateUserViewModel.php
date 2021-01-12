<?php

namespace App\ViewModels;

use App\Models\GroupUser;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\System\UserGroupRepository;
use Spatie\ViewModels\ViewModel;

class CreateUserViewModel extends ViewModel
{
    public function __construct(UserGroupRepository $userGroupRepository, CompanyRepository $companyRepository)
    {
		$this->userGroupRepository = $userGroupRepository;
		$this->companyRepository = $companyRepository;
	}

	public function groups()
	{
		$groups = $this->userGroupRepository;

		if(!current_user()->isSuperAdmin()) {
			$groups = $groups->whereNotIn('id', [GroupUser::SUPER_ADMIN]);
		}

		return $groups->get();
	}

	public function companies()
	{
		return $this->companyRepository->orderBy('company_name', 'asc')->get();
	}
}
