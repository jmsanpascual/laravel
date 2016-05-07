<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
        <link href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- CSS for Datatables -->
        <link href="{{ asset('node_modules/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('node_modules/angular-datatables/dist/css/angular-datatables.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('node_modules/datatables/plugins/buttons.bootstrap.min.css') }}">
        <link href="{{ asset('node_modules/angular-datatables/dist/plugins/bootstrap/datatables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('node_modules/datatables/plugins/fixedHeader.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('node_modules/angular-ui-select/select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        @yield('links')
    </head>
    <body ng-app="app">
        @yield('navbar')
        @yield('contents')

        <!-- Libraries and Frameworks -->
        <script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular/angular.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-resource/angular-resource.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-cookies/angular-cookies.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-ui-select/select.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js') }}"></script>
        <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-datatables/dist/angular-datatables.min.js') }}"></script>

        <!-- Button Scripts for angular-datatables -->
        <script src="{{ asset('node_modules/datatables/plugins/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('node_modules/datatables/plugins/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-datatables/dist/plugins/buttons/angular-datatables.buttons.min.js') }}"></script>
        <script src="{{ asset('node_modules/datatables/plugins/buttons.bootstrap.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.js') }}"></script>

        <!-- Fixed Header Scripts for angular-datatables -->
        <script src="{{ asset('node_modules/datatables/plugins/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ asset('node_modules/angular-datatables/dist/plugins/fixedheader/angular-datatables.fixedheader.min.js') }}"></script>

        <!-- Application Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/config/config.js') }}"></script>
        <script src="{{ asset('js/config/http-interceptor.factory.js') }}"></script>
        <script src="{{ asset('js/utility_modules/toast.js') }}"></script>
        @yield('scripts')
    </body>
</html>
