@extends('layouts.app')

@section('title', 'Должности')

@section('content')

    @foreach($positions as $position)
        <div class=" w-full hover:bg-base-300 shadow-xl bg-base-500 text-neutral-content mt-5 rounded-lg p-2">
            <div>
                <form action=" {{route('admin.position.update', $position->id)}}" method="post"
                      class=" w-full text-neutral-content mt-10 flex flex-col md:flex-row justify-between">
                    @csrf @method('PUT')

                    <input type="text" name="title"
                           class="input select-bordered w-full @error('title') select-error @enderror"
                           placeholder="Должность" title="Должность"
                           value="{{ $position->title }}">
                    <div class="flex flex-row">
                        <button class="btn btn-accent mt-5 md:mt-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </button>

                        <label for="my-modal" class="btn btn-error mt-5 md:mt-0" title="Удалить программу">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </label>
                    </div>
                </form>

                <div class="mt-5 md:mt-0">Содержит пользователей:
                    <div class="flex flex-col md:flex-row gap-4">
                        @foreach($position->users as $user)
                            <div><a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class=" w-full hover:bg-base-300 shadow-xl bg-base-500 text-neutral-content mt-10 p-5 rounded-md">
        <P>Добавить новую должность</P>
        <form action="{{route('admin.position.store')}}" method="post"
              class=" w-full text-neutral-content mt-10 flex flex-row justify-between">
            @csrf
            <input type="text" name="title"
                   class="input input-bordered w-full @error('title') select-error @enderror"
                   placeholder="Новая должность"
                   value="{{ old('title') }}">

            <div>
                <button class="btn btn-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>

            </div>

        </form>
    </div>

    @include('components.modalDelete', [
       'message' => "Вы желаете удалить должность $position->name",
       'route' => 'admin.position.destroy',
       'id' => $position->id
       ])

@endsection
