@extends('layouts.main')

@section('title')
    {{ $new['title'] }}
@endsection


@section('content')
    <div class="container">
        <h1>{{ $new['title'] }}</h1>
        <a  class="btn btn-primary" href="{{ route('news.all') }}">Назад </a>

        @if(!$new['private'])
            <p> {{ $new['text'] }}</p>
        @else
            <h5> Эту новость могут просматривать только зарегистрированные пользователи</h5>
        @endif
    </div>
@endsection
