@extends('layouts.app')

@section('title', 'Новости')

@section('content')

    <a class="btn mb-10" href="{{ route('admin.news.create') }}">Добавать новость</a>

    @include('components.news')

@endsection
