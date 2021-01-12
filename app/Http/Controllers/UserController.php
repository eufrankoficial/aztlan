<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\System\UserGroupRepository;
use App\Services\User\UserService;
use App\ViewModels\CreateUserViewModel;
use App\ViewModels\UserEditViewModel;
use App\ViewModels\UserListViewModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
	protected $userService;
	protected $userGroupRepository;
	protected $companyRepository;


    public function __construct(UserService  $userService, UserGroupRepository $userGroupRepository, CompanyRepository $companyRepository)
    {
		$this->userService = $userService;
		$this->userGroupRepository = $userGroupRepository;
		$this->companyRepository = $companyRepository;
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
		return (new CreateUserViewModel($this->userGroupRepository, $this->companyRepository))->view('users.create');
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
            $data = $request->except('_token', 'repeat_password', 'role_id');
			$user = $this->userService->create($data);
			$this->userService->syncRoles($user, [$request->get('role_id')]);

            return response()->json(['status' => true, 'url' => route('user.detail', $user)]);
        } catch (\Exception $e) {
			dd($e);
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
        return (new UserEditViewModel($user, $this->userGroupRepository, $this->companyRepository))->view('users.edit');
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
            $data = $request->except('_token', 'password', 'repeat_password', 'role_id');
			$this->userService->update($data, $user);
			$this->userService->syncRoles($user, [$request->get('role_id')]);

            return response()->json(['status' => true, 'url' => route('user.detail', $user->public_id)]);
        } catch (\Exception $e) {
			dd($e);
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
            return $this->userService->delete($user);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    public function exist(Request $request)
    {
        try {
            $exist = false;
            if($request->get('username')) {
                $user = $this->userService->findByUserName($request->get('username'));
                $exist = $user ? true : false;
                $exist = $user->username === trim($request->get('username')) ? false : true;
            } else {
                $user = $this->userService->findByUserName($request->get('email'));
                $exist = $user ? true : false;
                $exist = $user->email === trim($request->get('email')) ? false : true;
            }

            return response()->json(['status' => true, 'exist' => $exist]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
