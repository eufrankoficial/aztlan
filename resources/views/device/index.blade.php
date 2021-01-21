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
@stop
