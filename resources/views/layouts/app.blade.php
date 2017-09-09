<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .btn-primary {
          background-color: #ffffff !important;
          border-color: #367fa9 !important;
          color: #367fa9 !important;
        }

        .btn-primary:hover {
          background-color: #367fa9 !important;
          border-color: #1f4a63 !important;
          color: #fff !important;
        }

        .btn-default {
          background-color: #fff !important;
          color: #cc5b09 !important;
          border-color: #cc5b09 !important;
        }

        .btn-default:hover {
          background-color: #cc5b09 !important;
          color: #fff !important;
          border-color: #984509 !important;
        }

        .btn-danger {
          background-color: #fff !important;
          border-color: #d73925 !important;
          color: #d73925 !important;
        }

        .btn-danger:hover {
          background-color: #d73925 !important;
          border-color: #832014 !important;
          color: #fff !important;
        }

        .judul{
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       Dynasti Ice Cream
                    </a>
                </div>

            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
