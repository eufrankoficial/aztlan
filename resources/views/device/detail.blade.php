@extends('layouts.default', ['title' => 'Device #BD7D108F0'])
    @section('content')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>#BD7D108F0</h3>
                        <p>Dispositivo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>-3º</h3>
                        <p>Temperatura</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>25/11 - 11h35</h3>
                        <p>Ultima Atualização</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
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
                <div id="mymap" style="height: 260px; width: 100%;"></div>
            </div>
        </div>

        @section('scripts')
            <script>
                var mymap = L.map('mymap').setView([-22.969418269659766, -42.03011667055224], 13);

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmtlZGV2ZWxvcGVyIiwiYSI6ImNraHh1NDI2bDAzbzEyeGs2eW4yeGxkMG4ifQ.ceYsmLCMIDhoLtd8D7PPsA', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: 'pk.eyJ1IjoiZnJhbmtlZGV2ZWxvcGVyIiwiYSI6ImNraHh1NDI2bDAzbzEyeGs2eW4yeGxkMG4ifQ.ceYsmLCMIDhoLtd8D7PPsA'
                }).addTo(mymap);

                var circle = L.circle([-22.969418269659766, -42.03011667055224], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5,
                    radius: 100
                }).addTo(mymap);

                var polygon = L.polygon([
                    [-22.969418269659766, -42.03011667055224]
                ]).addTo(mymap);

                var popup = L.popup()
                    .setLatLng([-22.969418269659766, -42.03011667055224])
                    .setContent("I am here")
                    .openOn(mymap);
            </script>
        @endsection
    @stop
