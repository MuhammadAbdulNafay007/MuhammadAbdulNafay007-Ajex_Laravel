<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ajex Laravel')</title>
    @include('user.includes.style')

</head>
<body>
    @include('user.includes.header')
    @yield('content')
    @include('user.includes.script')
</body>
</html>
