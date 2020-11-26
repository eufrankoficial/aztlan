<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aztlan | CRM</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/css/login.min.css')  }}">
</head>
<body class="hold-transition login-page">
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ asset('assets/js/bundle.js')  }}"></script>
    <script src="{{ asset('assets/js/login.min.js')  }}"></script>
</body>
</html>
