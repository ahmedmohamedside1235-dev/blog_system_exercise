<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @Vite(['resources/css/app.scss', 'resources/js/app.js'])
    @yield('css')

</head>

<body>

    @hasSection('navbar')
        @yield('navbar')
    @endif

    @yield('content')

</body>

</html>
