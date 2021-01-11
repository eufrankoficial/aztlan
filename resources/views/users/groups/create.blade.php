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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputGroup">Grupo</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputGroup" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Permissões</label>
									<select name="permissions[]" class="form-control @error('permissions') is-invalid @enderror select2" id="permissions" multiple="multiple">
										@foreach($permissions as $permission)
											<option value="{{ $permission->id }}">
												{{ $permission->name }}
											</option>
										@endforeach
									</select>
                                </div>
                            </div>
						</div>
						<div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Menus de acesso</label>
									<select name="menus[]" class="form-control @error('menus') is-invalid @enderror select2" id="menus" multiple="multiple">
										@foreach($menus as $menu)
											@if($menu->parents->count() > 0)
												<optgroup label="{{ $menu->menu }}">
													@foreach($menu->parents as $parent)
														<option value="{{ $parent->id }}">{{ $parent->menu }}</option>
													@endforeach
												</optgroup>
											@else
												<optgroup label="{{ $menu->menu }}">
													<option value="{{ $menu->id }}">{{ $menu->menu }}</option>
												</optgroup>
											@endif
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
