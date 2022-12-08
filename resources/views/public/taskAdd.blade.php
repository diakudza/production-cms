@extends('layouts.app')

@section('title', 'Добавление задания')

@section('content')
    <div class="flex flex-col">

        @include('components.tabtask')
        @forelse($machines as $machine)
            <div class=" card border bg-base-100 shadow-xl mb-5 p-5 rounded-md">
                <p id="{{$machine->id}}" class="text-3xl">{{$machine->title}}</p>
                <div class="row-start-2 grid grid-cols-6 mt-1">
                    <div>Номер</div>
                    <div>Требуемое кол-во</div>
                    <div>Текущее кол-во</div>
                    <div>Дата сдачи</div>
                    <div>В работе / Завершить</div>
                </div>
                @foreach($machine->tasks as $task)
                    @php
                        $diff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($task->date), false)
                    @endphp
                    <div class="grid grid-cols-4 mt-1">
                        <form action="{{route('task.update', $task)}}"
                              class="col-span-4" method="POST">
                            <input type="hidden" name="machine_id" value="{{ $task->machine_id }}">
                            <div class="grid grid-cols-6 mt-1 ">
                                @csrf @method('PUT')
                                <div>
                                    <input type="text" class="input input-xs h-full" name="partNumber"
                                           value="{{ $task->partNumber }}">
                                </div>
                                <div>
                                    <input type="text" class="input input-xs h-full" name="count"
                                           value="{{ $task->count }} ">
                                </div>
                                <div>
                                    <input type="text" class="input input-xs h-full" name="currentCount"
                                           placeholder="{{ $task->currentCount }}">
                                </div>
                                <div>
                                    <input type="date" name="date" class="input input-xs h-full"
                                           value="{{ $task->date }}">
                                    @if($diff < 0)
                                        <span class="absolute  bg-red-900 "> Пр. {{ abs($diff) }} д.</span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-2 ">
                                    <div class="grid justify-center">
                                        <input type="checkbox" name="inWork"
                                                @checked($task->inWork == 1)
                                                class="checkbox checkbox-xs " value="1">
                                    </div>
                                    <div class="grid justify-center">
                                        <input type="checkbox" name="completed"
                                               class="checkbox checkbox-xs " value="1">
                                    </div>

                                </div>
                                <div class="grid-rows-1 grid justify-center">
                                    <div>
                                        <button class="btn btn-success btn-xs">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>

                                    </div>

                                </div>
                            </div>
                        </form>
                        <form action="{{route('task.destroy', $task)}}" class="col-start-6" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-error btn-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
                <form action="{{route('task.store')}}" class="grid grid-cols-6 mt-5 border rounded-md p-1"
                      method="POST">
                    @csrf
                    <input type="hidden" name="machine_id" value="{{ $machine->id }}">
                    <div>
                        <input type="text" name="partNumber" class="input input-xs h-full" placeholder="xxx">
                    </div>
                    <div>
                        <input type="text" name="count" class="input input-xs h-full" placeholder="0">
                    </div>
                    <div>
                        <input type="text" name="currentCount" class="input input-xs h-full" placeholder="0">
                    </div>
                    <div>
                        <input type="date" name="date" class="input input-xs h-full" placeholder="Срок">
                    </div>
                    <div class="grid justify-center place-content-center">
                        <input type="checkbox" name="inWork"
                               class="checkbox checkbox-xs " value="1">
                    </div>
                    <div class="grid place-content-center ">
                        <button class="btn btn-xs btn-success">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>

                </form>

            </div>
        @empty
            Нет Оборудования
        @endforelse

    </div>

@endsection
