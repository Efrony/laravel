<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
<body>
<a href="{{route('home')}}">Главная</a>
<a href="{{route('admin')}}">Админка</a>
<a href="{{route('news.categories')}}">Категории новостей</a>
<a href="{{route('news.all')}}">Все новости</a>

    @yield('content')

<style src="{{ asset('js/app.js') }}"></style>
</body>
</html>
