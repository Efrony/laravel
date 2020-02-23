<div class="mb-4">
    <a  class="btn btn-primary" href="{{ route('news.all') }}">Все новости</a>
    @foreach ($categories as $category)
            <a  class="btn btn-primary" href="{{ route('news.category', ['category' => $category->name]) }}">
                {{ $category->title }}
            </a>
    @endforeach
</div>
