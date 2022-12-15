@extends('layouts.app')

@section('title', 'Добавление новости')

@section('content')
    <div class="flex">
        <form action="{{ route('admin.news.store') }}" method="post" class="flex flex-col gap-4 w-full">
            @csrf @method('POST')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id  }}">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="title"
                           placeholder="Заголовок"
                           class="input select-bordered  md:w-96 @error('title') select-error @enderror"
                           title="Заголовок"
                           value="{{ old('title') }}">
                    <div class="flex justify-center ">
                        <input type="checkbox" class="checkbox" name="public" value="1"/>
                        <p>Публичная новость</p>
                    </div>
                </div>

                <textarea name="text"
                          class="textarea textarea-bordered resize-none h-96 " placeholder="text">
                        {{ old('text')  }}
                 </textarea>

            </div>
            <div class="flex-col md:flex-row flex gap-3">
                <button class="w-40 btn btn-success">Опубликовать</button>
                <button type="reset" class="w-40 btn btn-error">Сбросить</button>
            </div>
        </form>


    </div>
@endsection
