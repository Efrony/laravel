<a  class="btn btn-primary" href="{{ route('news.all') }}">Все новости</a>
@foreach ($categories as $category)
        <a  class="btn btn-primary" href="{{ route('news.category', ['category' => $category['id']]) }}">
            {{ $category['title'] }}
        </a>
@endforeach
