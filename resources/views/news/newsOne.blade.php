@extends('layouts.main')

@section('content')
        <a  class="btn btn-primary mb-4" href="{{ route('news.all') }}"> < Назад </a><br>

        @if($oneNews->private && !Auth::id())
            <h5> Эту новость могут просматривать только авторизованные пользователи</h5>
        @else
            <img class="card-img-top img-news-custom mb-5" src="{{ asset($oneNews->image) }}" alt="Card image cap">
            <p> {{ $oneNews->text }}</p>
        @endif
@endsection
