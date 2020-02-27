@extends('layouts.main')

@section('active_all')
    {{ 'active' }}
@endsection

@section('content')
        @include('widgets.newsCategories')

        <div class="flex-wrap-custom">
            @forelse($news as $oneNews)
                <div class="card cards-news-custom">
                    @if(!$oneNews->private)
                            <a href="{{ route('news.one', ['oneNews' => $oneNews]) }}">
                                <img class="card-img-top" src="{{ asset($oneNews->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $oneNews->title }} </h5>
                                    <p class="card-text-custom">{{ $oneNews->text }}</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </a>
                    @else
                                <img class="card-img-top" src="{{ asset($oneNews->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $oneNews->title }} </h5>
                                    <p> <b>Для просмотра этой новости необходимо авторизоваться</b></p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                    @endif
                </div>
            @empty
                <h2>Новостей нет</h2>
            @endforelse
        </div>
        <div class="pagination-custom">{{ $news->links() }}</div>
@endsection
