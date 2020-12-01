<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserService;
use App\ViewModels\UserEditViewModel;
use App\ViewModels\UserListViewModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService  $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        return (new UserListViewModel($this->userService, $request))->view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'repeat_password');
            $user = $this->userService->create($data);

            return response()->json(['status' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            $user = $this->userService->show($user);

            return response()->json(['status' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Http\Response.
     */
    public function edit(User $user)
    {
        return (new UserEditViewModel($user))->view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->except('_token', 'password', 'repeat_password');
            $this->userService->update($data, $user);

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user);

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
