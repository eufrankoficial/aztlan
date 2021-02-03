<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="base-url" content="{{ url()->to('/') }}">
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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h1>
								Relatório de <strong>{{ !empty($report['data']['device']->description) ? $report['data']['device']->description : $report['data']['device']->code_device }}</strong>
							</h1>
							<div class="card-tools">
								<h6>De: <strong>{{ $report['data']['initialDate']->format('d/m/Y H:i') }}</strong> à <strong>{{ $report['data']['finalDate']->format('d/m/Y H:i') }}</strong></h6>
								<span class="mailbox-read-time float-right">Gerado em {{ now()->format('d/m/Y H:i') }}</span>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<div class="mailbox-read-info">

							</div>
							<!-- /.mailbox-read-info -->
							<div class="mailbox-controls with-border text-center">
								<!-- /.btn-group -->
								<button type="button" class="btn btn-default btn-sm" title="Imprimir" onclick="window.print()">
									<i class="fas fa-print"></i>
								</button>
							</div>
							<!-- /.mailbox-controls -->
							<div class="mailbox-read-message">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										@forelse($report['report']['fields'] as $field)
											@if($field->show_on_report)
												<th>{{ $field->report_name }}</th>
											@endif
										@empty
											<td>Não foram encontrados dados nas datas escolhidas</td>
										@endforelse
									</tr>
									</thead>
									<tbody>
									@forelse($report['report']['lines'] as $key => $line)
										<tr>
											@foreach($line as $key=> $l)
												<td>{{ $l }}</td>
											@endforeach
										</tr>
									@empty
										<td>Não foram encontrados dados nas datas escolhidas</td>
									@endforelse
									</tbody>
								</table>
							</div>
							<div class="mailbox-read-message">
								<render-chart-on-report-component data="{{ $chart }}"></render-chart-on-report-component>
							</div>
							<!-- /.mailbox-read-message -->
						</div>
						<!-- /.card-footer -->
						<div class="card-footer">
							<button type="button" class="btn btn-default" title="Imprimir" onclick="window.print()"><i class="fas fa-print"></i> Imprimir </button>
						</div>
					</div>
					<!-- /.card -->
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
