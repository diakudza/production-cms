@extends('layouts.app')

@section('title', 'Вход')

@section('content')

    <div class="flex justify-center">

        <form action="{{ route('login') }}" method="post" class="mt-20 flex flex-col gap-4 w-96 ">
            @csrf
            <div class="flex flex-col md:flex-row gap-3">
                <input type="text" name="tabNumber"
                       class="input input-bordered  w-full @error('tabNumber') input-error @enderror"
                       placeholder="Таб. номер">
                <input type="password" name="password"
                       class="input input-bordered  w-full @error('tabNumber') input-error @enderror"
                       placeholder="Пароль">
            </div>
            <button class="btn  btn-accent">Войти</button>
        </form>
    </div>

@endsection
