@extends('layouts.main')

@section('title')
    {{ $new['title'] }}
@endsection

@section('content')
         <h1>{{ $new['title'] }}</h1>
         <p> {{ $new['text'] }}</p>
@endsection
