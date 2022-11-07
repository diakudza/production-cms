@extends('layouts.admin_app')

@section('title', 'Смены')

@section('content')

    <a class="btn gap-2" href="{{ route('admin.shift.create') }}">Новая смена</a>

    @foreach($shifts as $shift)
        <div class="card w-300 bg-neutral text-neutral-content mt-10">
            <form action="" method="post">
                @csrf
                <input type="text" name="number"
                       class="select select-bordered col-start-2 col-end-5 @error('number') select-error @enderror"
                       placeholder="D"
                       value="{{ $shift->number }}">
                <input type="time" name="start_time"
                       class="select select-bordered col-start-2 col-end-5 @error('start_time') select-error @enderror"
                       placeholder="D"
                       value="{{ $shift->start_time }}">
                <input type="time" name="end_time"
                       class="select select-bordered col-start-2 col-end-5 @error('end_time') select-error @enderror"
                       placeholder="D"
                       value="{{ $shift->end_time }}">
                <input type="text" name="week"
                       class="select select-bordered col-start-2 col-end-5 @error('week') select-error @enderror"
                       placeholder="D"
                       value="{{ $shift->week }}">
                <button class="btn btn-accent">Обновить</button>
                <a class="btn btn-error">Удалить</a>
            </form>
        </div>
    @endforeach

@endsection
