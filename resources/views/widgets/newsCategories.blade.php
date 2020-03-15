<div class="mb-4">
    <a  class="btn btn-primary mb-1" href="{{ route('news.all') }}">Все новости</a>
    @foreach ($categories as $category)
            <a  class="btn btn-primary mb-1" href="{{ route('news.category', ['category' => $category]) }}">
                {{ $category->title }}
            </a>
    @endforeach
</div>
