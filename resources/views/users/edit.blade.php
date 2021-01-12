@extends('layouts.default', [
    'title' => 'Editar - ' . $user->name,
    'breadcrumb' => 'user.detail',
    'param' => $user
])
    @section('content')
        <div class="row">
            <div class="col-lg-12">
				<user-edit-component
					user="{{ $user }}"
					action="{{ route('user.update', $user->public_id) }}"
					issuperadmin="{{ current_user()->isSuperAdmin() }}"
					groupsprop="{{ $groups }}"
					companiesprop="{{ $companies }}"
					>
				</user-edit-component>
            </div>
        </div>
    @endsection
