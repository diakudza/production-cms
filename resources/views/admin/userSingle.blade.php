@extends('layouts.app')

@section('title', "Пользователь $user->name")

@section('content')
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class=" w-100 bg-base-100 ">

                    <figure>
                        <img class="rounded-md" class="search__photo" src="@if(@isset($user->avatar)){{ Storage::url('image/profile/thumbnail/'. $user->avatar) }}
                                     @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                             alt="UserPhoto"/>

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
                           placeholder="D"
                           value="{{ $user->tabNumber }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Фио</span>
                    </div>
                    <input type="text" name="name"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           placeholder="D"
                           value="{{ $user->name }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Должность</span>
                    </div>
                    <select name="position_id" class="select select-bordered col-start-2 col-end-5">
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}"
                                @selected($user->position_id == $position->id)>{{ $position->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Смена</span>
                    </div>
                    <select name="shift_id" class="select select-bordered col-start-2 col-end-5">
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->id }}" @selected($user->shift_id == $shift->id)>
                                {{ $shift->number }} , на этой неделе @if (\Carbon\Carbon::now()->week() % 2 )
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
                           placeholder="Табельный номер"
                           value="{{ $user->employmentDate }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Статус</span>
                    </div>

                    <select name="status" class="select select-bordered col-start-2 col-end-5">
                        <option value="{{ \App\Enums\UserStatus::FIRED }}"
                            @selected($user->status == \App\Enums\UserStatus::FIRED)>Уволен
                        </option>
                        <option value="{{ \App\Enums\UserStatus::WORKS }}"
                            @selected($user->status == \App\Enums\UserStatus::WORKS)>Работает
                        </option>
                    </select>
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Роль</span>
                    </div>

                    <select name="role" class="select select-bordered col-start-2 col-end-5">
                        <option value="{{ \App\Enums\UserRole::ADMIN }}"
                            @selected($user->status == \App\Enums\UserRole::ADMIN)>Администратор
                        </option>
                        <option value="{{ \App\Enums\UserRole::USER }}"
                            @selected($user->status == \App\Enums\UserRole::USER)>Пользователь
                        </option>
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
                    <button href="" class="btn btn-success w-100">Обновить</button>
                    <label for="my-modal" class="btn btn-error">Удалить</label>
                </div>
            </div>
        </div>
    </form>

    @include('components.modalDelete', [
        'message' => "Вы желаете удалить пользователя $user->name",
        'route' => 'admin.user.destroy',
        'id' => $user->id
        ])

@endsection

