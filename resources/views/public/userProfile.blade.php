@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div>Страница профиля пользователя</div>
    <div class="grid grid-cols-2 gap-4 mt-10">

        <div>
            <div>Информация</div>
            <div>
                Вы добавили программ - {{auth()->user()->programs->count()}}
            </div>
            <div>
                На работе - {{ auth()->user()->getDaysOnServer() }} дней
            </div>


        </div>
        <div>
            <p>Настройки</p>
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
    <div class="mt-10">
        Ваши программы:
        @foreach($programs as $program)
            <div class="flex gap-3 w-full ">
                <div class="w-10"><a href="{{route('program.show', $program->id)}}">{{ $program->id }}</a></div>
                <div class="w-96">{{ $program->partNumber }}</a></div>
                <div class="w-100">{{ $program->machine->title }}</a></div>
            </div>
        @endforeach
    </div>
    </div>

@endsection
