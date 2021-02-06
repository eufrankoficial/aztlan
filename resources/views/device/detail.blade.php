@extends('layouts.default', ['title' => !empty($device->description) ? $device->description : 'Dispositivo ' . $device->code_device, 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')

    	<div class="row">
          	<div class="col-12">
			  	<div class="card">
              		<div class="card-header d-flex p-0">
                		<ul class="nav nav-pills ml-auto p-2">
							<li class="nav-item">
								<a class="nav-link active" href="#view" data-toggle="tab">Visualizar</a>
							</li>
							@if(current_user()->hasPermission('chart.view'))
								<li class="nav-item"><a class="nav-link" href="#charts" data-toggle="tab">Gráficos</a></li>
							@endif
							@if(current_user()->hasPermission('config.device.chart') || current_user()->hasPermission('config.device.field'))
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
										Configurações <span class="caret"></span>
									</a>
									<div class="dropdown-menu">
										@if(current_user()->hasPermission('config.device.chart'))
											<a class="dropdown-item" tabindex="-1" data-toggle="tab" href="#chartconfig">Gráficos</a>
										@endif
										@if(current_user()->hasPermission('config.device.field'))
											<a class="dropdown-item" tabindex="-1" data-toggle="tab" href="#fields">Campos</a>
										@endif
									</div>
								</li>
							@endif
						</ul>
              		</div>
              		<div class="card-body">
                		<div class="tab-content">
                  			<div class="tab-pane active" id="view">
								<view-device-detail-component
									devicejson="{{ $device }}"
									status="{{ $status }}"
								>
								</view-device-detail-component>
                  			</div>
							@if(current_user()->hasPermission('config.device.field'))
								<div class="tab-pane" id="fields">
									<device-field-list-component deviceprop="{{ $device }}" savefieldaction="{{ route('field.save') }}" getfieldsaction="{{ route('field.device.detail', $device) }}" typesprop="{{  $typeFields }}" actionsavedevice="{{ route('device.update', $device) }}" findcompanyaction="{{ route('company.find') }}"></device-field-list-component>
								</div>
							@endif
							<!-- /.tab-pane -->
							@if(current_user()->hasPermission('chart.view'))
								<div class="tab-pane" id="charts">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<render-chart-component device="{{ $device }}" action="{{ route('device.get.chart', $device) }}" actionreport="{{ route('device.post.report', $device) }}"/>
									</div>
								</div>
				  			@endif
							@if(current_user()->hasPermission('config.device.chart'))
								<div class="tab-pane" id="chartconfig">
									<device-chart-type-component
										types="{{ $chartTypes }}"
										fields="{{  $device->fields }}"
										action="{{ route('device.save.chart.config', $device) }}"
										deviceprop="{{ $device }}"
										>
									</device-chart-type-component>
								</div>
							@endif
						</div>
              		</div>
            	</div>
          	</div>
        </div>
    @endsection
