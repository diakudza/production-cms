@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="grid lg:grid-row-2 2xl:grid-cols-2 gap-4 ">
        <div class="w-full">

            <a href="{{ route('news.index') }}" class="text-2xl">Новости</a>

            @include('components.news')
        </div>
        <div class="">
            <div>
                @include('components.rating')
                <p class="text-2xl mb-10 mt-10">Последние добавленные программы</p>
                <table class="table w-full table-compact">
                    @foreach ($programs as $program)
                        <tr>
                            <td>
                                <div class="truncate w-52" title="{{ $program->partNumber }}">
                                    <a href="{{ route('program.show', $program->id) }}"> {{ $program->partNumber }}</a>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('search.part', ['author'=>$program->user->id]) }}">
                                    {{ $program->user->name }}
                                </a>
                            </td>
                            <td class="hidden md:block">
                                {{ $program->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if(session()->has('viewed'))
                <div class="mt-10 w-full overflow-hidden">
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
