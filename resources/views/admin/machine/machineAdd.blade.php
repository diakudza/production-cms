@extends('layouts.app')

@section('title', "Добавление оборудования")

@section('content')
    <form action="{{ route('admin.machine.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('POST')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class=" w-100 bg-base-100 ">

                    <figure>
                        <img class="rounded-md" class="search__photo"
                             src="{{ Storage::url('image/no_image.png') }}"
                             alt="MachinePhoto"/>
                    </figure>
                    <input type="file"
                           name="machinePhoto"
                           class="file-input file-input-bordered w-full max-w-xs
                           @error('machinePhoto') file-input-error @enderror"/>

                </div>
            </div>
            <div class="card gap-2">

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Заводской номер</span>
                    </div>
                    <input type="text" name="id"
                           class="select select-bordered  col-start-2 col-end-5 @error('tabNumber') select-error @enderror"
                           placeholder="0000"
                           value="{{ old('id') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Наименование</span>
                    </div>
                    <input type="text" name="title"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           placeholder="Станок"
                           value="{{ old('title') }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>IP адресс</span>
                    </div>
                    <input type="text" name="ip"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           placeholder="0.0.0.0"
                           value="0.0.0.0">
                </div>

                <div class="grid grid-cols-4 ">
                    <label class="label cursor-pointer">
                        <span class="programm__edit">На ремонте</span>
                    </label>
                    <input type="checkbox" name="repair" class="checkbox" value="0"/>
                </div>
                <div class="v-full mt-5">
                <textarea name="comment"
                          class="textarea textarea-bordered resize-none w-full h-3/4 mb-10"
                          placeholder="Поле для комментария">{{ old('comment') }}</textarea>
                </div>

                <div class="grid grid-cols-2 w-full">
                    <button href="" class="btn btn-success w-100">Добавить</button>
                    <button type="reset" class="btn btn-error">Стереть</button>
                </div>
            </div>
        </div>
    </form>

@endsection

