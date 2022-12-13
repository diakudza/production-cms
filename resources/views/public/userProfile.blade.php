@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="text-3xl">Страница профиля пользователя</div>

    <div class="grid grid-rows-1 xl:grid-cols-2 gap-4 mt-10">

        <div class="border rounded p-5">

            <div class="mb-5">Ваша статистика</div>
            <div class="mb-5">{{auth()->user()->name}} - {{auth()->user()->position->title}}</div>
            <div class="divider"></div>
            <div>
                @if(auth()->user()->status == 'WORKS')
                    Работает - {{ auth()->user()->getWorkingDays() }} дней
                @else
                    Уволен. Отработал {{ auth()->user()->getWorkingDays() }} дней
                @endif
            </div>
            <div class="divider"></div>
                        @if(in_array(auth()->user()->position_id, [1,2,3]))
            <div>
                Вы добавили программ - {{auth()->user()->programs->count()}} шт.
            </div>
            <div class="divider"></div>
            <div>
                <p>Вы писали программы под станки:</p>
                @foreach($favMachines as $machine)
                    <a href="{{ route('search.part', ['machine_id' => $machine->id, 'author' => auth()->id()]) }}">
                        <div> {{$machine->title}} - {{$machine->count}} шт.</div>
                    </a>
                @endforeach
            </div>

            <div class="divider"></div>
            <div class="mt-5 ">
                <p class="mt-5 mb-5">Ваши программы:</p>
                @foreach($programs as $program)
                    <div class="flex gap-3 w-full ">
                        <div>{{$loop->iteration}}</div>
                        <a href="{{route('program.show', $program->id)}}">
                            <div class="w-10">{{ $program->id }}</div>
                            <div class="w-96">{{ $program->partNumber }}</a></div>
                    <div class="w-100">
                        <a href="{{ route('search.part', ['machine_id'=>$program->machine->id]) }}">
                            {{ $program->machine->title }}
                        </a>
                    </div>
            </div>
                @endforeach
            </div>

                        @endif



    </div>

    <div class="border rounded p-5">
        <p class="mb-5">Настройки</p>
        <form action="{{route('user.update', auth()->user()->id)}}" method="post" class="flex gap-2">
            @csrf @method('PUT')
            <div class="programm__edit">
                <span>Тема</span>
            </div>
            <select name="theme_id"
                    class="select select-bordered col-start-2 col-end-5">
                @foreach($themes as $theme)
                    <option value="{{ $theme->id }}"
                        @selected($theme->id == auth()->user()->theme_id)>{{ $theme->title }}</option>
                @endforeach
            </select>

            <div class="v-full flex justify-between ">
                <button class="btn w-full"
                        title="Добавить">
                    Изменить
                </button>

            </div>
    </div>
    </form>
    </div>

    </div>

@endsection
