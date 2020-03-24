<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div class="container">
    @include('layouts.navigation')
    @yield('content')
    <div style="color: darkred;">
        @if($errors->any())
            <ul>
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </ul>
        @endif
    </div>
</div>
</body>
</html>
