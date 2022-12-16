@extends('layouts.app')

@section('title', 'Статистика')

@section('content')

    @forelse($logins as $login)
        <div class="w-full text-neutral-content mt-5 rounded-lg p-2 grid grid-flow-row md:grid-flow-col
            @if($login->success) bg-green-700 @else bg-red-900 @endif">
            <div class="w-6">{{ $login->id }}</div>
            <div class="w-30"><a href="{{route('admin.user.show', $login->user->id )}}">{{ $login->user->name }}</a></div>
            <div class="">{{ $login->user_agent }}</div>
            <div class="w-32">{{ $login->ip }}</div>
            <div>{{ $login->created_at}}</div>
        </div>
    @empty
        <span>Пока нет записей</span>
    @endforelse
@endsection
