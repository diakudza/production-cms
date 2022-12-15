@extends('layouts.app')

@section('title', 'Редактирование новости')

@section('content')
    <div class="flex flex-col">
        <form action="{{ route('news.update', $news->id) }}" method="post" class="flex flex-col gap-4 w-full">
            @csrf @method('PUT')
            <input type="hidden" name="user_id" value="{{ $news->user_id }}">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="title"
                           placeholder="Заголовок"
                           class="input select-bordered @error('start_time') select-error @enderror"
                           title="Заголовок"
                           value="{{ old('title') ?? $news->title }}">
                    <div class="flex justify-center ">
                        <input type="checkbox" name="public" value="1"
                               @checked( $news->public ) class="checkbox @error('public') checkbox-error @enderror"/>
                        <p>Публичная новость</p>
                    </div>
                </div>
                <textarea name="text"
                          class="textarea textarea-bordered resize-none h-96 " placeholder="text">
                    {{ old('text') ?? $news->text  }}
                 </textarea>

            </div>
            <button class="w-40 btn btn-success">Обновить</button>
        </form>
        <form action="{{ route('news.destroy', $news->id) }}" class="form-control gap-4">
            @csrf @method('PUT')
            <button class="w-40 btn btn-error">Удалить</button>
        </form>
    </div>
@endsection
