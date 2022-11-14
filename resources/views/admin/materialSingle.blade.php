@extends('layouts.app')

@section('title', "Матеарил $material->title")

@section('content')

    @php
        $colorFromDB = explode(',', $material->color);
    @endphp
    <form action="{{ route('admin.material.update', $material->id) }}"
          method="POST"
          class="grid grid-cols-6 gap-4">
        @csrf @method('PUT')

        <input type="text" name="title"
               class="select select-bordered  col-start-1 col-end-2 @error('title') select-error @enderror"
               placeholder="Обозначнеие"
               value="{{ $material->title }}">

        <x-select name="color">
            <option value="" disabled>Цвет</option>
            <option value="" >Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}" @selected($key == $colorFromDB[0])> {{$color}} </option>
            @endforeach
        </x-select>

        <x-select name="colorAdd">
            <option value="" disabled >Цвет</option>
            <option value="" >Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}"
                        @if(isset($colorFromDB[1]))
                            @selected($key == $colorFromDB[1])
                        @endif
                > {{$color}} </option>
            @endforeach
        </x-select>

        <input type="text" name="description"
               class="select select-bordered col-start-4 col-end-6 @error('description') select-error @enderror"
               placeholder="Описание"
               value="{{ $material->description }}">
        <div class="col-start-6 col-end-7">
            <div class="grid grid-cols-2 w-full">
                <button href="" class="btn btn-success w-100">Обновить</button>
                <label for="my-modal" class="btn btn-error">Удалить</label>
            </div>
        </div>
    </form>
    <div class="mt-10">
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

