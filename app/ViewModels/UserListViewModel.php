<?php

namespace App\ViewModels;

use App\Services\User\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Spatie\ViewModels\ViewModel;

class UserListViewModel extends ViewModel
{
    /**
     * @var UserService.
     */
    protected $userService;

    public function __construct(UserService $userService, Request $request)
    {
        $this->userService = $userService;
        $this->request = $request;
    }

    public function users(): LengthAwarePaginator
    {
        return $this->userService->list($this->request);
    }
}
