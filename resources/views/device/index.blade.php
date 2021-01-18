@extends('layouts.default',
    [
        'title' => 'Dispositivos',
        'breadcrumb' => 'device.index',
    ]
)
@section('content')
    <div class="row">
		@foreach($devices as $device)
			<div class="col-lg-3 col-6">
				<div class="small-box bg-success">
					<a href="{{ route('device.detail', $device) }}" class="block">
						<div class="inner">
							<h3>{{ $device->code_device }}</h3>
						</div>
						<div  class="small-box-footer">Detalhes
							<i class="fas fa-arrow-circle-right"></i>
						</div>
					</a>
				</div>
			</div>
    @endforeach
    </div>
@stop
