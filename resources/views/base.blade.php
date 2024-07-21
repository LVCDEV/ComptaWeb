<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/progress.css', 'resources/js/progress.js'])
    <title>{{ config('app.name') }} - @yield('page_title')</title>
</head>
<body>
@php use App\Models\Admin\UserType; @endphp
@php
    $routeName = request()->route()->getName();
    $admin = UserType::where('name', 'admin')->value('id');
@endphp
@include('navbar')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>
