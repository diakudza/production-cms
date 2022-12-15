@extends('layouts.app')

@section('title', 'Материалы')

@section('content')
    <a class="btn  mb-5"" href="{{route('admin.material.create')}}">Добавить материал</a>
    <div class="grid grid-flow-col border-b-2">
        <div>№</div>
        <div>Обозначение</div>
        <div>Маркировка</div>
        <div>Описание</div>
    </div>
        @foreach($materials as $material)

            @php
                $colorFromDb = explode(',', $material->color);
            @endphp

            <a href="{{ route('admin.material.edit', $material->id) }}">

            <div class="grid grid-flow-col h-10 hover:bg-base-300 shadow-xl mt-5 bg-base-500">
                <div class="b w-10">{{$loop->iteration}}</div>
                <div class="w-40">
                    <div>{{ $material->title }}</div>
                </div>
                <div class="w-32">
                    @isset($material->color)
                        @include('components.materialColour', ['color' => $material->color])
                    @endisset
                </div>
                <div class="w-40">
                    {{ $material->description }}
                </div>
            </div>
            </a>
        @endforeach
    </table>
@endsection
