<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserGroupRequest;
use App\Http\Requests\SaveUserGroupRequest;
use App\Models\GroupUser;
use App\Repositories\System\PermissionRepository;
use App\Repositories\System\UserGroupRepository;
use App\ViewModels\CreateUserGroupViewModel;
use App\ViewModels\EditUserGroupViewModel;
use App\ViewModels\ListUserGroupViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
	protected $groupUserRepository;
	protected $permissionRepository;

	public function __construct(UserGroupRepository $groupUserRepository, PermissionRepository $permissionRepository)
	{
		$this->userGroupRepository = $groupUserRepository;
		$this->permissionRepository = $permissionRepository;
	}

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListUserGroupViewModel($this->userGroupRepository))->view('users.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateUserGroupViewModel($this->permissionRepository))->view('users.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserGroupRequest $request)
    {
        try {

			DB::beginTransaction();

			$group = $this->userGroupRepository->save([
				'name' => $request->get('name')
			]);

			$this->userGroupRepository->syncPermissions($group, $request->get('permissions'));

			DB::commit();
			flash('Salvo com sucesso', 'success');

		} catch(\Exception $e) {
			DB::rollback();

			flash('Não foi possível salvar', 'danger');
		}

		return redirect()->route('user.groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupUser $group)
    {
		return (new EditUserGroupViewModel($group, $this->permissionRepository))->view('users.groups.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserGroupRequest $request, GroupUser $group)
    {
        try {
			DB::beginTransaction();

			$this->userGroupRepository->save(
				[
					'name' => $request->get('name')
				],
				$group->id
			);

			$this->userGroupRepository->syncPermissions($group, $request->get('permissions'));

			DB::commit();

			flash('Salvo com sucesso', 'success');


		} catch(\Exception $e) {
			DB::rollback();
			flash('Não possível salvar os dados do grupo', 'danger');
		}

		return redirect()->route('user.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
