@extends('layouts.default', ['title' => 'Dashboard', 'breadcrumb' => 'home.index'])
    @section('content')
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach($devices as $device)
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-{{ $device->detail->status }}">
                        <div class="inner">
                            <h3>#{{ $device->code_device }}</h3>

                            <p>Atualizado em {{ $device->detail->stamp }}</p>
                        </div>
                        <a href="#" class="small-box-footer">Detalhes <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
            <!-- ./col -->
        </div>
        <!-- /.row -->
    @stop
