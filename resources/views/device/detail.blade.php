@extends('layouts.default', ['title' => 'Dispositivo ' . $device->code_device, 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')

    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item">
                      <a class="nav-link active" href="#view" data-toggle="tab">Visualizar</a>
                    </li>
                  <li class="nav-item"><a class="nav-link" href="#charts" data-toggle="tab">Gráficos</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        Configurações <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" tabindex="-1" data-toggle="tab" href="#chartconfig">Gráficos</a>
                        <a class="dropdown-item" tabindex="-1" data-toggle="tab" href="#fields">Campos</a>
                    </div>
                  </li>
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
                  <div class="tab-pane" id="fields">
                    <device-field-list-component getfieldsaction="{{ route('field.device.detail') }}" typesprop="{{  $typeFields }}"></device-field-list-component>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="charts">
					  <div class="col-lg-12 col-md-12 col-sm-12">
						  <render-chart-component device="{{ $device }}" action="{{ route('device.get.chart', $device) }}" actionreport="{{ route('device.post.report', $device) }}"/>
					  </div>
                  </div>

                  <div class="tab-pane" id="chartconfig">
					<device-chart-type-component
						types="{{ $chartTypes }}"
						fields="{{  $device->fields }}"
						action="{{ route('device.save.chart.config', $device) }}"
						deviceprop="{{ $device }}"
						></device-chart-type-component>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endsection
