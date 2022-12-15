@php use App\Models\News; @endphp
@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    @can('create', News::class)
        <a class="btn mb-10" href="{{ route('news.create') }}">Добавить новость</a>
    @endcan
    @include('components.news')

@endsection
