@extends('layouts.app')

@section('title', "Станок $machine->id")

@section('content')
    <form action="{{ route('admin.machine.update', $machine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-flow-row md:grid-cols-2 gap-4">
            <div>
                <div class="w-100 bg-base-100 ">

                    <img class="rounded-md" class="search__photo" src="@if(@isset($machine->machinePhoto)){{ Storage::url('image/machines/thumbnail/'. $machine->machinePhoto) }}
                                     @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                         alt="MachinePhoto"/>

                    <input type="file"
                           name="machinePhoto"
                           class="file-input file-input-bordered w-full max-w-xs
                           @error('machinePhoto') file-input-error @enderror"/>

                    @if(@isset($machine->machinePhoto))
                        <div class="mt-5">
                            <input type="checkbox" name="machinePhotoDelete" class="checkbox" value="1"/>
                            <span>Убрать фото</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card gap-2">

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Заводской номер</span>
                    </div>
                    <input type="text" name="id"
                           class="select select-bordered  col-start-2 col-end-5 @error('tabNumber') select-error @enderror"
                           value="{{ $machine->id }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Наименование</span>
                    </div>
                    <input type="text" name="title"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           value="{{ $machine->title }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>Дата добавления</span>
                    </div>

                    <input type="text" name="created_at"
                           class="select select-bordered  col-start-2 col-end-5 @error('employmentDate') select-error @enderror"
                           value="{{ $machine->created_at->format('d-m-Y') }}">
                </div>
                <div class="grid grid-cols-4 ">
                    <div class="programm__edit">
                        <span>IP адресс</span>
                    </div>
                    <input type="text" name="ip"
                           class="select select-bordered col-start-2 col-end-5 @error('name') select-error @enderror"
                           value="{{ $machine->ip }}">
                </div>

                <div class="grid grid-cols-4 ">
                    <label class="label cursor-pointer">
                        <span class="programm__edit">На ремонте</span>
                    </label>
                    <input type="checkbox" name="repair" class="checkbox" @checked($machine->repair) value="1"/>
                </div>
                <div class="v-full mt-5">
                <textarea name="comment"
                          class="textarea textarea-bordered resize-none w-full h-3/4 mb-10"
                          placeholder="Поле для комментария">{{ $machine->comment ?? NULL}}</textarea>
                </div>

                <div class="grid grid-cols-2 w-full">
                    <button href="" class="btn btn-success w-100">Обновить</button>
                    <label for="my-modal" class="btn btn-error">Удалить</label>
                </div>
            </div>
        </div>
    </form>

    @include('components.modalDelete', [
        'message' => "Вы желаете удалить $machine->id",
        'route' => 'admin.machine.destroy',
        'id' => $machine->id
        ])


    <div class="mt-5">
        <p>Программы для это станка:</p>
        <table>
            @forelse($programs as $program)
                <div class="flex gap-3 w-full ">
                    <div class="w-10"><a href="{{route('program.show', $program->id)}}">{{ $program->id }}</a></div>
                    <div class="w-96"><a href="{{route('program.show', $program->id)}}">{{ $program->partNumber }}</a>
                    </div>
                    <div class="w-96"><a
                            href="{{route('admin.user.show', $program->user->id)}}">{{ $program->user->name }}</a></div>
                </div>
            @empty
                <p>Пока не добалены</p>
            @endforelse
        </table>
    </div>
@endsection

