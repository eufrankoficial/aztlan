<?php

namespace App\ViewModels;

use App\Models\User;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\System\UserGroupRepository;
use Spatie\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    /**
     * @var User.
     */
    protected $user;

    public function __construct(User $user, UserGroupRepository $userGroupRepository, CompanyRepository $companyRepository)
    {
		$this->user = $user;
		$this->user->load(['roles']);
		$this->userGroupRepository = $userGroupRepository;
		$this->companyRepository = $companyRepository;
    }

    public function user(): User
    {
        return $this->user;
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
