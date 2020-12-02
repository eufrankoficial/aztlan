@extends('layouts.default', ['title' => 'Device #BD7D108F0', 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>#{{ $device->code_device }}</h3>
                        <p>Dispositivo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{  number_format($device->detail->temp, 1, ',', '.') }}º</h3>
                        <p>Temperatura</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $device->detail->stamp->diffForHumans() }}</h3>
                        <p>Ultima Atualização</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-{{ $device->detail->status }}">
                    <div class="inner">
                        <h3>Online</h3>
                        <p>Status</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informações adicionais</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bateria</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="70%">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Umidade</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" value="51,4%">
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-6">
                <div id="mapContainer" style="height: 260px; width: 100%;"></div>
                <map-component map="{{ $device }}"></map-component>
            </div>
        </div>
    @endsection
