@extends('layouts.app')

@section('title', "Матеарил $material->title")

@section('content')

    @php
        $colorFromDB = explode(',', $material->color);
    @endphp
    <form action="{{ route('admin.material.update', $material->id) }}"
          method="POST"
          class="grid grid-rows-4 md:grid-cols-5 md:grid-rows-1 w-full gap-5">
        @csrf @method('PUT')

        <input type="text" name="title"
               class="select select-bordered  @error('title') select-error @enderror"
               placeholder="Обозначение"
               value="{{ $material->title }}">

        <x-select name="color">
            <option value="" disabled>Цвет</option>
            <option value="">Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}" @selected($key == $colorFromDB[0])> {{$color}} </option>
            @endforeach
        </x-select>

        <x-select name="colorAdd">
            <option value="" disabled>Цвет</option>
            <option value="">Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}"
                @if(isset($colorFromDB[1]))
                    @selected($key == $colorFromDB[1])
                    @endif
                > {{$color}} </option>
            @endforeach
        </x-select>

        <input type="text" name="description"
               class="select select-bordered  @error('description') select-error @enderror"
               placeholder="Описание"
               value="{{ $material->description }}">
        <div class="w-32">
            <div class="grid grid-cols-2 gap-4">
                <button href="" class="btn btn-success w-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <label for="my-modal" class="btn btn-error">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </label>
            </div>
        </div>
    </form>
    <div class="mt-5">
        Программ где используется этот материал: {{ $material->programs->count() }}
        <div class="flex">
            <p>Маркировка:</p>
            <div class="w-10">
                @include('components.materialColour', ['color' => $material->color])
            </div>
        </div>
    </div>
    @include('components.modalDelete', [
        'message' => "Вы желаете удалить материал $material->title",
        'route' => 'admin.material.destroy',
        'id' => $material->id
        ])

@endsection

