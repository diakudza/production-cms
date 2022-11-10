@extends('layouts.app')

@section('title', 'Оборудование')

@section('content')

    @foreach($machines as $machine)
        <div class=" w-full bg-neutral text-neutral-content mt-5 rounded-lg p-2">
            <form action=" {{route('admin.machine.update', $machine->id)}}" method="post"
                  class=" w-full bg-neutral text-neutral-content mt-10 flex flex-row justify-between">
                @csrf @method('PUT')
                <input type="text" name="id"
                       class="input input-bordered w-25 @error('id') select-error @enderror"
                       placeholder="Номер оборудования" title="Номер оборудования"
                       value="{{ $machine->id }}">
                <input type="text" name="title"
                       class="input select-bordered col-start-2 col-end-5 @error('title') select-error @enderror"
                       placeholder="Наименование оборудования" title="Наименование оборудования"
                       value="{{ $machine->title }}">
                <input type="text" name="ip" title="IP адресс"
                       class="input select-bordered col-start-2 col-end-5 @error('ip') select-error @enderror"
                       placeholder="IP"
                       value="{{ $machine->ip }}">
                <input type="text" name="created_at" title="Дата установки"
                       class="input select-bordered col-start-2 col-end-5 @error('created_at') select-error @enderror"
                       placeholder="Дата"
                       value="{{ $machine->created_at }}">
                <div class="flex flex-col justify-center ">
                    <input type="checkbox" name="repair" value="1"
                           @checked($machine->repair == 1) class="checkbox @error('repair') checkbox-error @enderror"/>
                    <p>Ремонт</p>
                </div>

                <div>
                    <button class="btn btn-accent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>

                    <label for="my-modal" class="btn btn-error" title="Удалить программу">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </label>
                </div>

            </form>
            <form action="{{ route('search.part') }}">

                <input type="hidden" name="partNumber" value="">
                <input type="hidden" name="machine_id" value="{{ $machine->id }}">
                <div>Колличество программ на станок:
                    <button>{{ $machine->programs->count() }}
                        <button>
                </div>
            </form>

        </div>
    @endforeach

    <div class=" w-full bg-neutral text-neutral-content mt-10 p-5 rounded-md">
        <P>Добавить оборудование</P>
        <form action="{{route('admin.machine.store')}}" method="post"
              class=" w-full bg-neutral text-neutral-content mt-10 flex flex-row justify-between">
            @csrf
            <input type="text" name="id"
                   class="input input-bordered w-25 @error('id') input-error @enderror"
                   placeholder="Номер оборудования"
                   value="{{ old('id') }}">

            <input type="text" name="title"
                   class="input input-bordered w-25 @error('title') input-error @enderror"
                   placeholder="Наименование оборудования"
                   value="{{ old('title') }}">

            <input type="text" name="ip"
                   class="input input-bordered w-25 @error('ip') input-error @enderror"
                   placeholder="IP"
                   value="{{ old('ip') }}">

            <input type="date" name="created_at" title="Дата установки"
                   class="input input-bordered w-25 @error('created_at') input-error @enderror"
                   placeholder="Дата установки"
                   value="{{ old('created_at') }}">

            <button class="btn btn-accent">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>


        </form>
    </div>

    @include('components.modalDelete', [
       'message' => "Вы желаете удалить смену $machine->title",
       'route' => 'admin.machine.destroy',
       'id' => $machine->id
       ])

@endsection
