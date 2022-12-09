@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="grid grid-cols-2 gap-4">

        @include('components.news')

        <div class="">
            <div>
                <p class="text-4xl mb-10">Последние добавленные программы</p>
                <table class="table w-full table-compact">
                    @foreach ($programs as $program)
                        <tr>
                            <td>
                                <div class="truncate w-52" title="{{ $program->partNumber }}">
                                    <a href="{{ route('program.show', $program->id) }}"> {{ $program->partNumber }}</a>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('search.part', ['author_id'=>$program->user->id]) }}">
                                {{ $program->user->name }}
                                </a>
                            </td>
                            <td>
                                {{ $program->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if(session()->has('viewed'))
            <div class="mt-10">
                    Просмотренные программы:
                <div>
                    @foreach(session()->get('viewed') as $id=> $item )
                      <a class="btn btn-ghost" href="{{ route('program.show', $id) }}">{{ $item }}</a>
                    @endforeach
                </div>

            </div>
            @endif
        </div>
    </div>

@endsection
