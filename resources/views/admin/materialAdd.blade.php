@extends('layouts.app')

@section('title', "Добавить новый матеарил")

@section('content')

    <form action="{{ route('admin.material.store') }}"
          method="POST"
          class="grid grid-cols-6 gap-4">
        @csrf

        <input type="text" name="title"
               class="select select-bordered  col-start-1 col-end-2 @error('title') select-error @enderror"
               placeholder="Обозначнеие"
               value="{{ old('title') }}">

        <x-select name="color">
            <option value="" disabled>Цвет</option>
            <option value="">Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}" @selected($key == old('color'))> {{ $color }} </option>
            @endforeach
        </x-select>

        <x-select name="colorAdd">
            <option value="" disabled>Цвет</option>
            <option value="">Не указывать</option>
            @foreach(config('colors') as $key => $color)
                <option value="{{ $key }}" @selected($key == old('colorAdd')) > {{ $color }} </option>
            @endforeach
        </x-select>

        <input type="text" name="description"
               class="select select-bordered col-start-4 col-end-6 @error('description') select-error @enderror"
               placeholder="Описание"
               value="{{ old('description') }}">
        <div class="col-start-6 col-end-7">
            <div class="grid grid-cols-2 w-full">
                <button href="" class="btn btn-success w-100">Добавить</button>
            </div>
        </div>
    </form>


@endsection

