@extends('layouts.default', [
    'title' => 'Novo',
    'breadcrumb' => 'user.create',
])
@section('content')
    <div class="row">
        <div class="col-lg-12">
			<user-create-component
				action="{{ route('user.store') }}"
				groups="{{ $groups }}"
				issuperadmin="{{ current_user()->isSuperAdmin() }}"
				companiesprop="{{ $companies }}"
				>
			</user-create-component>
        </div>
    </div>
@endsection
