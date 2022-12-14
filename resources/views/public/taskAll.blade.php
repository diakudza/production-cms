@php use App\Models\Task;use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('title', 'Задания')

@section('content')

    @if(auth()->user() && auth()->user()->can('update', Task::class))
        <a class="btn" href="{{route('task.show', 'active')}}">Изменить задания</a>
    @endif
    <div class="flex flex-col">
        @forelse($machines as $machine)
            <div class="card rounded-md shadow-xl mt-5 hover:bg-base-300 mt-5 p-5 rounded-md">
                <p class="text-3xl">{{$machine->title}}</p>

                <div class="grid grid-cols-4 mt-1">
                    <div>Номер</div>
                    <div>Требуемое кол-во</div>
                    <div>Текущее кол-во</div>
                    <div>Дата сдачи</div>
                </div>

                <div>
                    @foreach($machine->tasks as $task)
                        @php
                            $diff = Carbon::now()->diffInDays(Carbon::parse($task->date), false)
                        @endphp
                        <div class="grid grid-cols-4 mt-1 @if ($diff < 0) bg-red-900 @endif">
                            <div class="overflow-hidden break-after-column"><a href="{{route('search.part', ['partNumber'=>$task->partNumber])}}">{{ $task->partNumber }}</a>
                                @if($task->inWork)
                                    <span class="hidden bg-green-700 rounded-md md:inline">В работе</span>
                                @endif
                            </div>
                            <div>{{ $task->count }} </div>
                            <div>{{ $task->currentCount }} </div>
                            <div class="overflow-hidden">{{ $task->date }}
                                @if($diff < 0)
                                    <span class="hidden md:inline">
                                    Просрочка {{ abs($diff) }} д.</span>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @empty
            нет заданий
        @endforelse

    </div>

@endsection
