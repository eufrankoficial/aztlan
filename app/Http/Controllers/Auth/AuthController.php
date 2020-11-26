<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }

    public function authenticate(Request $request)
    {
        try {

            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json(
                    [
                        'status' => true
                    ]
                );
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
