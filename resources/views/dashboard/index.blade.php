@extends('layouts.default')
    @section('content')
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach($devices as $device)
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-{{ $device->status }}">
                        <div class="inner">
                            <h3>#{{ $device->id }}</h3>

                            <p>Atualizado em {{ $device->stamp }}</p>
                        </div>
                        <a href="#" class="small-box-footer">Detalhes <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
            <!-- ./col -->
        </div>
        <!-- /.row -->
    @stop
