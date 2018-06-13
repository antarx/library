<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/line-awesome/css/line-awesome-font-awesome.min.css') }}" rel="stylesheet">
    @stack('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ request()->segment(2) }}">
    @include('frontend.layouts.includes.header')

    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 col-md-3 d-md-block d-none sidebar sidebar-left">
                @include('backend.layouts.includes.sidebar')
            </aside>
            <main class="main col-lg-10 col-md-9 ml-sm-auto content content-right">
                @yield('content')
            </main>
        </div>
    </div>

    @include('backend.layouts.includes.footer')

    {{ Form::open(['route' => 'admin.logout', 'method' => 'post', 'id' => 'form-logout', 'class' => 'd-none']) }}
    {{ Form::close() }}

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap4/js/bootstrap.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>