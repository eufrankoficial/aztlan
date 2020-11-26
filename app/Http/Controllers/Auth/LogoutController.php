<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;

class LogoutController extends Controller
{
    /**
     * @var AuthService.
     */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json(['status' => true]);
    }
}
