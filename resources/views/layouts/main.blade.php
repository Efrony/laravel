<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title> @yield('title') </title>
<body>
    @include('widgets.navbar')

    <div class="container">

        @include('widgets.alert')

        @isset($title)
            <h1 class="mt-5 mb-4">{{ $title }}</h1>
        @endisset

        @yield('content')
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
