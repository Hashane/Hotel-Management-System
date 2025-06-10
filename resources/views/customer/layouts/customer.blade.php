<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="description" content="Sharons Template"/>
    <meta name="keywords" content="Sharons, unica, creative, html"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title', 'My App')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap"
        rel="stylesheet"
    />
</head>
<body>
@include('customer.partials.header')
@include('components.alerts')
<main>
    @yield('content')
</main>

@include('customer.partials.footer')
@stack('scripts')
</body>
</html>
