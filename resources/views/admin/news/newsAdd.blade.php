@extends('layouts.app')

@section('title', 'Добавление новости')

@section('content')
    <div class="flex">
        <form action="{{ route('admin.news.store') }}" method="post" class="flex gap-4">
            @csrf @method('POST')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id  }}">
            <div class="flex flex-col w-96 gap-2">
                <input type="text" name="title"
                       placeholder="Заголовок"
                       class="input select-bordered col-start-2 col-end-5 @error('title') select-error @enderror"
                       title="Заголовок"
                       value="{{ old('title') }}">
                <textarea name="text"
                          class="textarea textarea-bordered resize-none h-96 " placeholder="text">
                        {{ old('text')  }}
                 </textarea>
                <div class="flex justify-center ">
                    <input type="checkbox" name="public" value="1" />
                    <p>Публичная новость(Отображается на главной всем)</p>
                </div>
            </div>

            <button class="w-40 btn btn-success">Опубликовать</button>
            <button type="reset" class="w-40 btn btn-error">Сбросить</button>
        </form>


    </div>
@endsection
