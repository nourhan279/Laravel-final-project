<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpeg') }}">
    @yield('styles')
</head>
<body>
    @include('includes.header')

    <div id="main">
        @yield('content')
    </div>

    @include('includes.footer')

    @yield('scripts')
</body>
</html>
