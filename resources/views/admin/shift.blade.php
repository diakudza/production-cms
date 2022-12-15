@extends('layouts.app')

@section('title', 'Смены')

@section('content')

    @foreach($shifts as $shift)
        <div class=" w-full hover:bg-base-300 shadow-xl bg-base-500 text-neutral-content mt-5 rounded-lg p-2">
            <form action=" {{route('admin.shift.update', $shift->id)}}" method="post"
                  class=" w-full text-neutral-content mt-10 flex flex-col md:flex-row justify-between">
                @csrf @method('PUT')
                <input type="text" name="number"
                       class="input input-bordered w-25 @error('number') select-error @enderror"
                       placeholder="Номер смены" title="Номер смены"
                       value="{{ $shift->number }}">
                <input type="time" name="start_time"
                       class="input select-bordered col-start-2 col-end-5 @error('start_time') select-error @enderror"
                       placeholder="D" title="Начало смены"
                       value="{{ $shift->start_time }}">
                <input type="time" name="end_time" title="Конец смены"
                       class="input select-bordered col-start-2 col-end-5 @error('end_time') select-error @enderror"
                       placeholder="D"
                       value="{{ $shift->end_time }}">
                <div class="flex flex-row mt-2 md:flex-col justify-center ">
                    <input type="checkbox" name="week" value="1"
                           @checked($shift->week == 1) class="checkbox @error('week') checkbox-error @enderror"/>
                    <p>Четная неделя</p>
                </div>

                <div>
                    <button class="btn btn-accent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>

                    <label for="my-modal" class="btn btn-error" title="Удалить программу">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </label>
                </div>

            </form>
            <div>Содержит пользователей:
                <div class="flex flex-col md:flex-row gap-4">
                    @foreach($shift->users as $user)
                        <div><a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class=" w-full hover:bg-base-300 text-neutral-content mt-10 p-5 rounded-md">
        <P>Добавить новую смену</P>
        <form action="{{route('admin.shift.store')}}" method="post"
              class=" w-full text-neutral-content mt-10 flex flex-col md:flex-row justify-between">
            @csrf
            <input type="text" name="number"
                   class="input input-bordered w-25 @error('number') select-error @enderror"
                   placeholder="Номер смены"
                   value="{{ old('number') }}">

            <input type="time" name="start_time"
                   step="1"
                   class="input select-bordered col-start-2 col-end-5 @error('start_time') select-error @enderror"
                   title="Начало смены"
                   value="{{ old('start_time') }}">

            <input type="time" name="end_time"

                   title="Конец смены"
                   class="input select-bordered col-start-2 col-end-5 @error('end_time') select-error @enderror"
                   step="1"
                   value="{{ old('end_time') }}">
            <div class="flex flex-col justify-center ">
                <input type="checkbox" name="week" value="1"
                       @checked(old('week')) class="checkbox @error('week') checkbox-error @enderror"/>
                <p>Четная неделя</p>
            </div>

            <div>
                <button class="btn btn-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>

                <label for="my-modal" class="btn btn-error" title="Удалить программу">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </label>
            </div>

        </form>
    </div>

    @include('components.modalDelete', [
       'message' => "Вы желаете удалить смену $shift->name",
       'route' => 'admin.shift.destroy',
       'id' => $shift->id
       ])

@endsection
