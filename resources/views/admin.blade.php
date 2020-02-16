@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')
    <h1>{{ $title }}</h1>
@endsection
