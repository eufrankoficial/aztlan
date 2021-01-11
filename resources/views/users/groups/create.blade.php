@extends('layouts.default', [
    'title' => 'Adicionar grupo',
    'breadcrumb' => 'user.groups.add'
])
    @section('content')
        <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('user.groups.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputGroup">Grupo</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputGroup" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Permissões</label>
									<select name="permissions[]" class="form-control @error('permissions') is-invalid @enderror select2" id="permissions" multiple="multiple">
										@foreach($permissions as $permission)
											<option value="{{ $permission->slug }}">
												{{ $permission->name }}
											</option>
										@endforeach
									</select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
