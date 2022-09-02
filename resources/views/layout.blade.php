<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('partials._head')
    @yield('insert-css')
</head>
<body>
    @include('partials._navbar')
    @yield('content')
    @include('partials._footer')
    @yield('insert-js')
</body>
</html>
