<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AL2 - DASHBOARD</title>

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
                        <h1 class="invoice-title">Dispositivo <strong>{{ $report['data']['device']->code_device }}</strong></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <br><br>
                            <p>
                                <strong>Criado em: </strong>
                                {{ now()->format('d/m/Y H:i') }}
                                <br>
                                <strong>
                                    Datas:
                                </strong>
                                 {{ $report['data']['initialDate']->format('d/m/Y H:i') }} à {{ $report['data']['finalDate']->format('d/m/Y H:i') }}
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
								@foreach($report['report']['fields'] as $field)
									@if($field->show_on_report)
										<th>{{ $field->report_name }}</th>
									@endif
								@endforeach
							</tr>
                        </thead>
                        <tbody>
							@foreach($report['report']['lines'] as $key => $line)
								<tr>
									@foreach($line as $key=> $l)
										<td>{{ $l }}</td>
									@endforeach
								</tr>
							@endforeach
						</tbody>
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
