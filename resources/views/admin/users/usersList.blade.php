@php use App\Enums\UserStatus;use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
    <a class="btn gap-2" href="{{ route('admin.user.create') }}">Новый пользователь</a>

    <div class=" mt-5">

        <div class="hidden md:grid grid-flow-col border-b-2 mt-2  auto-cols-max pl-3">
            <div class="w-16">Таб.</div>
            <div class="w-16 ">Фото</div>
            <div class="w-32 pl-3">ФИО</div>
            <div class="w-32">Дата уст.</div>
            <div class="w-24">Смена</div>
            <div class="w-[500px]">Должность</div>
            <div class="w-32">Статус</div>
            <div class="w-16">Роль</div>
        </div>

        @foreach($users as $user)
            <a href="{{ route('admin.user.show', $user->id) }}">

                <div class="grid rounded-md shadow-xl mt-5 hover:bg-base-300 p-3 xl:auto-cols-max md:grid-flow-col">

                    <div class="col-start-2 md:w-16 md:col-start-1">
                        <span class="md:hidden">Таб: </span>{{ $user->tabNumber }}
                    </div>

                    <div class="w-16 row-start-1 md:row-span-1 row-span-3">
                        <img class="rounded-md" src="
                                    @if(@isset($user->avatar))
                                    {{ Storage::url('image/profile/thumbnail/'. $user->avatar) }}
                                    @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                             alt="UserPhoto"/>
                    </div>

                    <div class="md:w-32 md:pl-3"><span class="md:hidden">ФИО: </span>{{ $user->name }}</div>
                    <div class="md:w-32 "><span class="md:hidden">Дата уст.: </span>{{ $user->employmentDate }}</div>
                    <div class="md:w-24">
                        @if ($user->status == UserStatus::WORKS->name)
                            <span class="md:hidden">Смена: </span>
                            @if (Carbon::now()->week() % 2 != $user->shift->week)
                                первая
                            @else
                                вторая
                            @endif
                        @endif
                    </div>
                    <div class="md:w-[500px]">{{ $user->position->title ?? null }}</div>
                    <div class="w-32">
                        <span class="md:hidden">Статус: </span> @if($user->status == UserStatus::FIRED->name){{ UserStatus::FIRED }}
                        @else{{ UserStatus::WORKS }}@endif
                    </div>
                    <div class="w-32"><span class="md:hidden">Роль: </span>{{ $user->role }}</div>
                </div>

            </a>
        @endforeach
    </div>

@endsection
