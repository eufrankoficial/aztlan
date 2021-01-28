@extends('layouts.default',
    [
        'title' => 'Dispositivos',
        'breadcrumb' => 'device.index',
    ]
)
@section('content')
    <div class="row">
		@foreach($devices as $device)
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="small-box bg-{{ $device->status }} p-3">
					<a href="{{ route('device.detail', $device) }}" class="block">
						<div class="inner">
							<h4>{{ $device->code_device }}</h4>
						</div>
						<div  class="small-box-footer">Detalhes
							<i class="fas fa-arrow-circle-right"></i>
						</div>
					</a>
				</div>
			</div>
    	@endforeach
    </div>
	@if($devices->count() > 30)
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						@include('partials.pagination', ['data' => $devices])
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
	@endif
@stop
