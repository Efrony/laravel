@extends('layouts.main')

@section('active_all')
    {{ 'active' }}
@endsection

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('news.newsCategories')

        <div style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
            @forelse($news as $new)
                <div class="card" style="width: 23%; margin-top: 30px; ">
                    <a href="{{ route('news.one', ['id' => $new['id']]) }}">
                        <img class="card-img-top" src="{{ asset('img/280.svg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $new['title'] }} </h5>
                            <p class="card-text">{{ $new['text'] }}</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </a>
                </div>
            @empty
                <h2>Новостей нет</h2>
            @endforelse
        </div>
    </div>
@endsection
