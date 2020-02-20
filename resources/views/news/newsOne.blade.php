@extends('layouts.main')

@section('content')

        <a  class="btn btn-primary mb-4" href="{{ route('news.all') }}"> < Назад </a>

        @if(!$new['private'])
            <p> {{ $new['text'] }}</p>
        @else
            <h5> Эту новость могут просматривать только авторизованные пользователи</h5>
        @endif
@endsection
