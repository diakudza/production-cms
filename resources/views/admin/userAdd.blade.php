@extends('layouts.admin_app')

@section('title', 'Пользователи')

@section('content')
    <form action="{{ route('admin.user.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class=" w-100 bg-base-100 ">

                    <figure>
                        <img class="rounded-md" class="search__photo" src="@if(@isset($user->avatar)){{ Vite::asset('public/storage/image/profile/thumbnail/'. $user->avatar) }}
                                     @else
                                    {{ Vite::asset('public/storage/image/no_image.png') }}
                                    @endif"
                             alt="Shoes"/>

                    </figure>
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
                           placeholder="D"
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
                    <select name="shift" class="select select-bordered col-start-2 col-end-5">
                        <option value="0" @selected($user->shift == 0)>0</option>
                        <option value="1" @selected($user->shift == 1)>1</option>
                        <option value="2" @selected($user->shift == 2)>2</option>
                    </select>
                </div>
                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Дата устройства</span>
                    </div>

                    <input type="date" name="employmentDate"
                           class="select select-bordered  col-start-2 col-end-5 @error('employmentDate') select-error @enderror"
                           placeholder="Табельный номер"
                           value="{{ $user->employmentDate }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Статус</span>
                    </div>

                    <select name="status" class="select select-bordered col-start-2 col-end-5">
                        <option value="{{ \App\Enums\UserStatus::FIRED }}"
                            @selected($user->status == \App\Enums\UserStatus::FIRED)>Уволен</option>
                        <option value="{{ \App\Enums\UserStatus::WORKS }}"
                            @selected($user->status == \App\Enums\UserStatus::WORKS)>Работает</option>
                    </select>
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Роль</span>
                    </div>

                    <select name="role" class="select select-bordered col-start-2 col-end-5">
                        <option value="{{ \App\Enums\UserRole::ADMIN }}"
                            @selected($user->status == \App\Enums\UserRole::ADMIN)>Администратор</option>
                        <option value="{{ \App\Enums\UserRole::USER }}"
                            @selected($user->status == \App\Enums\UserRole::USER)>Пользователь</option>
                    </select>
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Телефон</span>
                    </div>

                    <input type="text" name="phone"
                           class="select select-bordered  col-start-2 col-end-5 @error('phone') select-error @enderror"
                           placeholder="+7(222)1234567"
                           value="{{ $user->phone }}">
                </div>

                <div class="v-full mt-5">
                <textarea name="description"
                          class="textarea textarea-bordered resize-none w-full h-3/4 mb-10"
                          placeholder="Описание не указанно">{{ $user->description ?? NULL}}</textarea>
                </div>

                <div class="grid grid-cols-2 w-full">
                    <button href="" class="btn w-100">Обновить</button>
                    <a href="" class="btn">Удалить</a>
                </div>
            </div>
        </div>
    </form>
@endsection
