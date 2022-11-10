@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="grid grid-cols-2 gap-4">

        @include('components.news')

        <div class="">
            <p class="text-4xl mb-10">Последние программы</p>
            <table class="table w-full">
                @foreach ($programs as $program)
                    <tr>
                        <td>
                            <div class="truncate w-52" title="{{ $program->partNumber }}">
                                <a href="{{ route('program.show', $program->id) }}"> {{ $program->partNumber }}</a>
                            </div>
                        </td>
                        <td>
                            {{ $program->user->name }}
                        </td>
                        <td>
                            {{ $program->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
