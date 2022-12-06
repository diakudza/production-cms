@extends('layouts.app')

@section('title', 'Редактирование новости')

@section('content')
    <div class="flex">
        <form action="{{ route('admin.news.update', $news->id) }}" method="post" class="flex gap-4">
            @csrf @method('PUT')
            <input type="hidden" name="user_id" value="{{ $news->user_id }}">
            <div class="flex flex-col w-96 gap-2">
                <input type="text" name="title"
                       placeholder="Заголовок"
                       class="input select-bordered col-start-2 col-end-5 @error('start_time') select-error @enderror"
                       title="Заголовок"
                       value="{{ old('title') ?? $news->title }}">
                <textarea name="text"
                          class="textarea textarea-bordered resize-none h-96 " placeholder="text">
                    {{ old('text') ?? $news->text  }}
                 </textarea>
                <div class="flex justify-center ">
                    <input type="checkbox" name="public" value="1"
                           @checked( $news->public ) class="checkbox @error('public') checkbox-error @enderror"/>
                    <p>Публичная новость(Отображается на главной всем)</p>
                </div>
            </div>
            <button class="w-40 btn btn-success">Сохранить</button>
        </form>
        <form action="{{ route('admin.news.destroy', $news->id) }}" class="form-control gap-4">
            @csrf @method('PUT')
            <button class="w-40 btn btn-error">Удалить</button>
        </form>
    </div>
@endsection
