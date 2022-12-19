@extends('layouts.app')

@section('title', 'Оборудование')

@section('content')

    <a href="{{route('admin.machine.create')}}" class="btn gap-2">Добавить новое оборудование</a>
    <div class="hidden md:grid w-full  grid-flow-col mt-5">

        <div>Номер</div>
        <div>Фото</div>
        <div>Наименование</div>
        <div>IP</div>
        <div>Дата добавления</div>
        <div>Кол-во программ</div>

    </div>
    @forelse($machines as $machine)
        <div class="grid grid-flow-col hover:bg-base-300 shadow-xl mt-5 rounded-lg p-2 @if ($machine->repair) bg-red-900 @endif">
            <div>
                <a href="{{route('admin.machine.show', $machine)}}">{{ $machine->id }} @if ($machine->repair)
                        <svg class="w-6 h-6 absolute " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    @endif</a>
            </div>
            <div>
                <div class="w-20">
                    <img class="rounded-md" class="search__photo" src="@if(@isset($machine->machinePhoto)){{ Storage::url('image/machines/thumbnail/'. $machine->machinePhoto) }}
                                    @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                         alt="MachinePhoto"/>
                </div>
            </div>
            <div>{{ $machine->title }}</div>
            <div>{{ $machine->ip }}</div>
            <div>{{ $machine->created_at->format('Y-m-d') }}</div>
            <div>
                <a href="{{ route('search.part', ['partNumber'=>'', 'machine_id'=>$machine->id]) }} ">{{ $machine->programs->count() }}</a>
            </div>
        </div>
    @empty
        <h2>Пока нет добавленного оборудования. Пожалуйста, добавьте ниже.</h2>
        @endforelse
        </div>

        @endsection
