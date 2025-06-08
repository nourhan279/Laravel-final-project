<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpeg') }}">
    @yield('styles')
</head>
<body>
    @include('includes.Arabic_header')

    <div id="main">
        @yield('content')
    </div>

    @include('includes.Arabic_footer')

    @yield('scripts')
</body>
</html>
