@extends('layouts.app')

@section('title', 'Материалы')

@section('content')
    <a class="btn" href="{{route('admin.material.create')}}">Добавть материал</a>
    <table class="table table-zebra w-full mt-5">
        <th>№</th>
        <th>Обозначение</th>
        <th>Маркировка</th>
        <th>Описание</th>

        @foreach($materials as $material)

            @php
                $colorFromDb = explode(',', $material->color);
            @endphp

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <div><a href="{{ route('admin.material.edit', $material->id) }}">{{ $material->title }}</a></div>
                </td>
                <td>
                    @isset($material->color)
                        @include('components.materialColour', ['color' => $material->color])
                    @endisset
                </td>
                <td>
                    {{ $material->description }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
