<?php

namespace App\ViewModels;

use App\Models\User;
use Spatie\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    /**
     * @var User.
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
