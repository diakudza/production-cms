@php
    use App\Enums\UserStatus;
    use App\Enums\UserRole;
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title', "Новый пользователь")

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class=" w-100 bg-base-100 ">

                    <input type="file"
                           name="avatar"
                           class="file-input file-input-bordered w-full max-w-xs
                           @error('avatar') file-input-error @enderror"/>
                </div>
            </div>
            <div class="card gap-2">

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Табельный номер</span>
                    </div>
                    <input type="text" name="tabNumber"
                           class="select select-bordered  col-start-2 col-end-5 @error('tabNumber') select-error @enderror"
                           placeholder="Табельный номер"
                           value="{{ old('tabNumber') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Фио</span>
                    </div>
                    <input type="text" name="name"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           placeholder="Фио"
                           value="{{ old('name') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Должность</span>
                    </div>
                    <select name="position_id" class="select select-bordered col-start-2 col-end-5">
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}"
                                @selected(old('position_id') == $position->id)>{{ $position->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Смена</span>
                    </div>
                    <select name="shift_id" class="select select-bordered col-start-2 col-end-5">
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->id }}" @selected(old('shift_id') == $shift->id)>
                                {{ $shift->number }} , на этой неделе @if (Carbon::now()->week() % 2 )
                                    первая
                                @else
                                    вторая
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Дата устройства</span>
                    </div>

                    <input type="date" name="employmentDate"
                           class="select select-bordered  col-start-2 col-end-5 @error('employmentDate') select-error @enderror"
                           placeholder="Дата устройства"
                           value="{{ old('employmentDate') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Статус</span>
                    </div>

                    <select name="status" class="select select-bordered col-start-2 col-end-5">
                        @foreach(UserStatus::cases() as $item)
                            <option value="{{ $item->name }}"
                                @selected(old('status') == $item->name)>{{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Роль</span>
                    </div>

                    <select name="role" class="select select-bordered col-start-2 col-end-5">
                        @foreach(UserRole::cases() as $item)
                            <option value="{{ $item->name }}"
                                @selected(old('role') == $item->name)>{{$item->value}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Телефон</span>
                    </div>

                    <input type="text" name="phone"
                           class="select select-bordered  col-start-2 col-end-5 @error('phone') select-error @enderror"
                           placeholder="+7(222)1234567"
                           value="{{ old('phone') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Пароль</span>
                    </div>

                    <input type="password" name="password"
                           class="select select-bordered  col-start-2 col-end-5 @error('phone') select-error @enderror"
                           placeholder="Пароль"
                           value="">
                    <input type="password" name="password_confirmation"
                           class="select select-bordered  col-start-2 col-end-5 @error('phone') select-error @enderror"
                           placeholder="Подтверждение парола"
                           value="">
                </div>

                <div class="v-full mt-5">
                <textarea name="description"
                          class="textarea textarea-bordered resize-none w-full h-3/4 mb-10"
                          placeholder="Описание не указанно">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 w-full">
                    <button href="" class="btn btn-success w-100">Добавить</button>
                </div>
            </div>
        </div>
    </form>

@endsection

