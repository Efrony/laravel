@extends('layouts.main')

@section('title')
{{ $title }}
@endsection

@section('content')
<h1>{{ $title }}</h1>
@foreach ($news as $new)
    <a href="{{ route('news.one', ['id' => $new['id']]) }}">
        <h3> {{ $new['title'] }} </h3>
        <p> {{ $new['text'] }}</p>
    </a>
@endforeach
@endsection
