@extends('adminlte::page')

@section('title', $title ?? config('app.name'))

@section('content_header')
    @isset($title)
        <h1>{{ $title }}</h1>
    @endisset
@endsection

@section('content')
    {{ $slot }}
@endsection
