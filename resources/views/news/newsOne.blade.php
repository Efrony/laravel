@extends('layouts.main')

@section('title')
    {{ $new['title'] }}
@endsection


@section('content')
    <div class="container">
        <h1>{{ $new['title'] }}</h1>
        <a  class="btn btn-primary" href="{{ route('news.all') }}">Назад </a>
        <p> {{ $new['text'] }}</p>
    </div>
@endsection
