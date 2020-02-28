@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')
    @include('widgets.newsCategories')

    <div class="flex-wrap-custom">
        @forelse($news as $oneNews)
            <div class="card cards-news-custom">
                <a href="{{ route('news.one', ['oneNews' => $oneNews]) }}">
                    <img class="card-img-top" src="{{ asset($oneNews->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $oneNews->title }} </h5>
                        <p class="card-text-custom">{{ $oneNews->text }}</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                @if($oneNews->private)
                    <span class="ml-4">
                        <b>Приватная</b>
                    </span>
                @endif
                <div class="ml-4 mr-4 mb-3 cards-news-buttons-custom">
                    <a style="color: darkgreen" href="{{ route('admin.news.update', $oneNews) }}">Редактировать</a>
                    <a style="color: red" href="{{ route('admin.news.delete', $oneNews) }}">Удалить</a>
                </div>
            </div>
        @empty
            <h2>Новостей нет</h2>
        @endforelse
    </div>
    <div class="pagination-custom">{{ $news->links() }}</div>
@endsection
