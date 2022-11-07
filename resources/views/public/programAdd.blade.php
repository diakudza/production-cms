@extends('layouts.app')

@section('title', 'Добавить программу')

@section('content')
    <form action="{{ route('program.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-3 gap-4 ">
            <div class="grid grid-rows-4">
                <div class="mb-5">
                    <input type="file" name="partPhoto"
                           class="file-input file-input-bordered w-full max-w-xs @error('partPhoto') file-input-error @enderror"/>

                </div>

                <div class="flex flex-col gap-1 v-80">
                    <div class="grid grid-cols-4 ">
                        <div class="programm__edit">
                            <span>Номер</span>
                        </div>
                        <input type="text" name="partNumber"
                               class="select select-bordered  col-start-2 col-end-5 @error('partNumber') select-error @enderror"
                               placeholder="ххх-хх-х"
                               value="{{ old('partNumber') }}">
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Станок</span>
                        </div>
                        <select name="machine_id"
                                class="select select-bordered  col-start-2 col-end-5
                        @error('machine_id') select-error @enderror">
                            <option disabled @if (!old('machine_id'))selected @endif >Станок</option>
                            @foreach($machines as $machine)
                                <option
                                    value="{{ $machine->id }}">{{ $machine->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Тип</span>
                        </div>
                        <select name="partType_id"
                                class="select select-bordered col-start-2 col-end-5
                        @error('partType_id') select-error @enderror">
                            <option disabled @if (!old('partType_id'))selected @endif >Тип детали</option>
                            @foreach($partTypes as $partType)
                                <option
                                    value="{{ $partType->id }}">{{ $partType->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? null }}">

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Материал</span>
                        </div>
                        <select name="material_id"
                                class="select select-bordered col-start-2 col-end-3">
                            <option disabled @if (!old('material_id'))selected @endif >Материал</option>
                            @foreach($materials as $material)
                                <option
                                    value="{{ $material->id }}">{{ $material->title }}</option>
                            @endforeach
                        </select>

                        <select name="materialType"
                                class="select select-bordered col-start-3 col-end-4
                            @error('materialType') select-error @enderror">
                            <option disabled @if (!old('materialType'))selected @endif >ТИП</option>
                            <option value="round" @selected(old('materialType') == 'round')>Круг</option>
                            <option value="hexagon" @selected(old('materialType')== 'hexagon')>Шестигранник</option>
                            <option value="tube" @selected(old('materialType') == 'tube'))>Труба</option>
                            <option value="square" @selected(old('materialType') == 'square')>Квадрат</option>
                        </select>

                        <input type="text" name="materialDiametr"
                               class="select select-bordered  col-start-4 col-end-5 @error('materialDiametr') select-error @enderror"
                               placeholder="D"
                               value="{{ old('materialDiametr') }}">
                    </div>

                </div>

                <div class="mt-10">
                <textarea name="description"
                          class="textarea textarea-bordered resize-none w-full h-3/4 mb-10" placeholder="Описание"></textarea>
                </div>

                <div class="v-full flex justify-between ">
                    <button class="btn w-full"
                            title="Добавить"
                        @disabled( auth()->user()->cannot('create', \App\Models\Program::class))>
                        Добавить
                    </button>

                </div>
            </div>

            <div class="relative">
                <input type="text" name="programNameForHead1"
                       class="input input-bordered  max-w-xs @error('programNameForHead1') input-error @enderror"
                       placeholder="Имя программы 1" value="{{ old('programNameForHead1')  }}">
                <textarea id="programText1" class="textarea textarea-bordered w-full h-3/4"
                          placeholder="Bio" name="programTextForHead1">{{ old('programTextForHead1') }}</textarea>
            </div>
            <div class="relative">
                <input type="text" name="programNameForHead2"
                       class="input input-bordered  max-w-xs @error('programNameForHead2') input-error @enderror"
                       placeholder="Имя программы 2" value="{{ old('programNameForHead2')  }}">
                <textarea id="programText2" class="textarea textarea-bordered w-full h-3/4"
                          placeholder="Bio" name="programTextForHead2">{{ old('programTextForHead2') }}</textarea>
            </div>

        </div>
    </form>

@endsection
