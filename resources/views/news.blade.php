@extends('layouts.main')

@section('title')
{{ $title }}
@endsection

@section('content')
<h1>Новости</h1>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias architecto assumenda at dignissimos dolor, dolores
ea eaque exercitationem harum iure nam necessitatibus nisi numquam, omnis perferendis ratione reiciendis voluptas
voluptatem!

@foreach ($news as $new)
    <p> {{ $new }}</p>
@endforeach
@endsection
