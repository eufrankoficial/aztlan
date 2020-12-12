<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AZTLAN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/default.min.css') }}">
</head>
<body class="hold-transition">
<div id="app">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h1 class="invoice-title">Dispositivo <strong>#{{ $report->code_device }}</strong></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <br><br>
                            <p>
                                <strong>Criado em: </strong>
                                10.12
                                <br>
                                <strong>
                                    Datas:
                                </strong>
                                Entre 12.12 à 18.12
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <img src="{{ asset('assets/img/logos/global.jpeg') }}" alt="Logo" style="float: right" class="brand-image" width="254" height="100">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Bateria</th>
                            <th>Temperatura</th>
                            <th>Umidade</th>
                            <th>Contador</th>
                            <th>CO2</th>
                            <th>Temperatura DHT 1</th>
                            <th>Temperatura DHT 2</th>
                            <th>Umidade DHT1</th>
                            <th>Umidade DHT2</th>
                            <th>Data de atualização</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($report->history as $history)
                            <tr>
                                <td>{{ $history->lat }}</td>
                                <td>{{ $history->lon }}</td>
                                <td>{{ $history->bat }}VW</td>
                                <td>{{ $history->temp }}ºC</td>
                                <td>{{ $history->umi }}%</td>
                                <td>{{ $history->cnt }}</td>
                                <td>{{ $history->co2 }}ppm</td>
                                <td>{{ $history->tempdht1 }}ºC</td>
                                <td>{{ $history->tempdht2 }}ºC</td>
                                <td>{{ $history->umidht1 }}</td>
                                <td>{{ $history->umidht2 }}</td>
                                <td>{{ $history->stamp->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->


<script src="{{ asset('assets/js/bundle.js')  }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

@yield('scripts')

<script src="{{ asset('assets/js/default.min.js') }}"></script>


</body>
</html>
