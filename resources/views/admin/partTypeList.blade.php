@extends('layouts.app')

@section('title', 'Типы деталей')

@section('content')

    <div class="flex flex-row w-full">
        <div class="w-14">№</div>
        <div>Обозначение</div>
    </div>
    @foreach($partTypes as $partType)
        <div class="flex flex-row w-full hover:bg-base-300 shadow-xl mt-5 bg-base-500 gap-3 align-middle rounded-lg p-3">
            <div class="w-10">{{$loop->iteration}}</div>
            <div class="flex w-full">
                <form action="{{ route('admin.partType.update', $partType->id) }}" class="w-full flex gap-3" method="POST">
                    @csrf @method('PUT')
                    <input type="text" class="input w-full" name="title" value="{{ $partType->title }}">
                    <button class="btn btn-success">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </form>

            </div>
            <form action="{{ route('admin.partType.destroy', $partType->id) }}"  method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-error ">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        </div>
    @endforeach

    <div class=" w-full bg-neutral text-neutral-content mt-10 p-5 rounded-md">
        <P>Добавить новый тип</P>
        <form action="{{route('admin.partType.store')}}" method="post"
              class=" w-full bg-neutral text-neutral-content mt-10 flex flex-row justify-between">
            @csrf
            <input type="text" name="title"
                   class="input input-bordered w-full @error('title') select-error @enderror"
                   placeholder="Новый тип"
                   value="{{ old('title') }}">

            <div>
                <button class="btn btn-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>

            </div>

        </form>
    </div>
@endsection
