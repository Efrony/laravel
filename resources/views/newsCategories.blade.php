@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <h1>{{ $title }}</h1>

    @foreach ($categories as $category)
        <a href="/news/categories/{{$category['category']}}">{{$category['title']}}</a>
        <br>
    @endforeach
@endsection
