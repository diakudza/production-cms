@extends('layouts.app')

@section('title', 'Программа')

@section('content')
    <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid md:grid-cols-1 xl:grid-cols-3 gap-4 ">
            <div class="grid grid-rows-4">
                <div class="w-full flex justify-center mb-5" >
                    <img src="@if (@isset($program->partPhoto)) {{ Storage::url('image/programs/thumbnail/'. $program->partPhoto)  }}
                        @else
                            {{ Storage::url('image/no_image.png') }}
                            @endif"
                         alt="Shoes"
                         class="rounded-badge h-56"/>
                    @if(auth()->user() && ( auth()->user()->isAdmin() || auth()->user()->can('update', $program)))
                        <input type="file"
                               name="partPhoto"
                               class="file-input absolute file-input-bordered w-full max-w-xs
                           @error('partPhoto') file-input-error @enderror"/>
                    @endif
                </div>
                {{--Select bloc start--}}
                <div class="flex flex-col gap-1">
                    <div class="grid grid-cols-4 ">
                        <div class="programm__edit">
                            <span>Номер</span>
                        </div>
                        <input type="text" name="partNumber" class="select select-bordered  col-start-2 col-end-5"
                               value="{{ $program->partNumber }}"
                            @disabled(!auth()->user() || !auth()->user()->can('update', $program))>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Станок</span>
                        </div>
                        <select name="machine_id"
                                class="select select-bordered  col-start-2 col-end-5" @disabled(!auth()->user() || !auth()->user()->can('update', $program))>
                            @foreach($machines as $machine)
                                <option
                                    value="{{ $machine->id }}"
                                    @selected($machine->id == $program->machine_id)
                                >{{ $machine->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Тип</span>
                        </div>
                        <select name="partType_id"
                                class="select select-bordered col-start-2 col-end-5" @disabled(!auth()->user() || !auth()->user()->can('update', $program))>
                            @foreach($partTypes as $partType)
                                <option
                                    value="{{ $partType->id }}"
                                    @selected($partType->id == $program->partType_id)>{{ $partType->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="programm__edit">
                            <span>Материал</span>
                        </div>
                        <select name="material_id"
                                class="select select-bordered col-start-2 col-end-3"
                            @disabled(!auth()->user() || !auth()->user()->can('update', $program))>
                            <option disabled @if (!old('material_id'))selected @endif >Материал</option>
                            @foreach($materials as $material)
                                <option
                                    value="{{ $material->id }}" @selected($program->material_id == $material->id)>{{ $material->title }}</option>
                            @endforeach
                        </select>
                        <select name="materialType"
                                class="select select-bordered col-start-3 col-end-4
                            @error(old('materialType')) select-error @enderror"
                            @disabled(!auth()->user() || !auth()->user()->can('update', $program))>
                            <option value="round" @selected($program->materialType == 'round')>Круг</option>
                            <option value="hexagon" @selected($program->materialType == 'hexagon')>Шестигранник</option>
                            <option value="tube" @selected($program->materialType == 'tube')>Труба</option>
                            <option value="square" @selected($program->materialType == 'square')>Квадрат</option>
                        </select>
                        <input type="text" name="materialDiameter"
                               @disabled(!auth()->user() || !auth()->user()->can('update', $program))
                               class="select select-bordered  col-start-4 col-end-5 @error('materialDiameter') select-error @enderror"
                               placeholder="D"
                               value="{{ $program->materialDiameter }}">
                    </div>

                    @if(auth()->user() && auth()->user()->isAdmin())
                        <div class="grid grid-cols-4">
                            <div class="programm__edit">
                                <span>Добавил</span>
                            </div>
                            <select name="user_id"
                                    class="select select-bordered col-start-2 col-end-5"
                                @disabled(!auth()->user() || !auth()->user()->isAdmin())>
                                @foreach($authors as $auhtor)
                                    <option
                                        value="{{ $auhtor->id }}"
                                        @selected($auhtor->id == $program->user_id)
                                    >{{ $auhtor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if(auth()->user() && !auth()->user()->isAdmin())
                        <input type="hidden" name="user_id" value="{{ $program->user_id }}">
                    @endif

                </div>
                {{--Select bloc end--}}

                <div class="v-full mt-5">
                <textarea name="description"
                          class="textarea textarea-bordered resize-none w-full  h-3/4 mb-10"
                          @disabled(!auth()->user() || !auth()->user()->can('update', $program))
                          placeholder="Описание не указанно">{{ $program->description ?? NULL}}</textarea>
                </div>

                {{--Action buttons--}}
                <div class="v-full flex justify-between ">

                    <button class="btn w-20"
                            @disabled(!auth()->user() || !auth()->user()->can('update', $program)) title="Сохранить изменения">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>

                    <a class="btn w-20" @disabled(!auth()->user()) title="Отправить на FTP сервер">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </a>

                    <label for="my-modal" class="btn btn-error"
                           @disabled(!auth()->user() || !auth()->user()->can('update', $program)) title="Удалить программу">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </label>
                </div>
                {{--Action buttons end--}}

            </div>

            <div class="relative v-50">
                <input type="text"
                       name="title_1"
                       class="input input-bordered max-w-xs @error('title_1') input-error @enderror"
                       placeholder="Номер в формате O1111"
                       @disabled(!auth()->user() || !auth()->user()->can('update', $program))
                       pattern="[O]{1}[0-9]{4}"
                       value="{{ $program->title_1 }}">
                <div class="absolute right-1 top-0">
                    <a href="{{route('program.getProgram', [$program, 1])}}"
                        class="btn w-19"
                       title="Загрузить на компьютер">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </a>
                    <a class="btn w-19" title="Скопирвать в буфер" onclick="copyFunction(programText1)">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </a>
                </div>

                <textarea id="programText1"
                          class="textarea textarea-bordered w-full h-3/4 mt-1"
                          name="text_1"
                          placeholder="Program text"
                    @readonly(!auth()->user() || !auth()->user()->can('update', $program))>{{ $program->text_1 }}</textarea>
            </div>

            <div class="relative">
                <input type="text"
                       name="title_2"
                       class="input input-bordered  max-w-xs @error('title_2') input-error @enderror"
                       @disabled(!auth()->user() || !auth()->user()->can('update', $program))
                       placeholder="Номер в формате O1111"
                       pattern="[O]{1}[0-9]{4}"
                       value="{{ $program->title_2 }}">
                <div class="absolute right-1 top-0">
                    <a href="{{route('program.getProgram', [$program, 2])}}"
                        class="btn w-19" title="Загрузить на компьютер">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </a>
                    <a class="btn w-19" title="Скопирвать в буфер" onclick="copyFunction(programText2)">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </a>
                </div>
                <textarea id="programText2"
                          class="textarea textarea-bordered w-full h-3/4 mt-1"
                          name="text_2"
                          placeholder="Program text"
                    @readonly(!auth()->user() || !auth()->user()->can('update', $program))>{{ $program->text_2 }}</textarea>
            </div>

        </div>
    </form>

    @include('components.modalDelete', [
        'message' => "Вы желаете удалить программу $program->partNumber ?",
        'route' => 'program.destroy',
        'id' => $program->id
        ])

    <script>
        function copyFunction(id) {
            console.log(id);
            let copyText = id;
            copyText.select();
            document.execCommand("copy");
            alert("Текст скопирован в буфер обмена");
        }

    </script>

@endsection

@push('scripts')
    <script>
        function copyFunction(id) {
            console.log(id);
            let copyText = id;
            copyText.select();
            document.execCommand("copy");
            alert("Текст скопирован в буфер обмена");
        }

    </script>
    {{--        <script>--}}
    {{--        function deleteA(id, url, redirectUrl) {--}}
    {{--            if (confirm('Вы точно хотите удалить?')) {--}}
    {{--            send(url).then(() => {--}}
    {{--            document.location.href = redirectUrl--}}
    {{--        })--}}
    {{--        }--}}
    {{--        }--}}

    {{--        async function send(url) {--}}
    {{--            let response = await fetch(url, {--}}
    {{--            method: 'DELETE',--}}
    {{--            headers: {--}}
    {{--            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')--}}
    {{--        }--}}
    {{--        });--}}
    {{--            let result = await response.json();--}}
    {{--            return result.ok;--}}
    {{--        }--}}
    {{--    </script>--}}
@endpush
