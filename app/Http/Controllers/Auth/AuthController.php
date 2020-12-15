<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    /**
     * @var AuthService.
     */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.login.index');
    }

    public function authenticate(Request $request)
    {
        try {
            $authenticated = $this->authService->authenticate(
                [
                    'username' => $request->get('username'),
                    'password' => $request->get('password')
                ],
                (bool) $request->get('remember')
             );

            if ($authenticated) {
                $this->authService->cacheConfigsUser();
                return response()->json(['status' => true]);
            } else {
            }
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->json(
            [
                'status' => false
            ]
        );

    }
}
