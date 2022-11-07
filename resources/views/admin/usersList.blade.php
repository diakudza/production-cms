@extends('layouts.admin_app')

@section('title', 'Пользователи')

@section('content')
    <a class="btn gap-2" href="{{ route('admin.user.create') }}">Новый пользователь</a>
    <table class="table table-zebra">
        <th>
        <td>Таб. ном.</td>
        <td>Фото</td>
        <td>Фио</td>
        <td>Дата добавления</td>
        <td>На этой недели</td>
        <td>Должность</td>
        <td>Статус</td>
        <td>Роль</td>

        </th>
        @foreach($users as $user)

            <tr>
                <td></td>
                <td>
                    <a href="{{ route('admin.user.show', $user->id) }}">
                        {{ $user->tabNumber }}
                    </a>
                </td>
                <td>
                    <div class=" w-20 bg-base-100 ">
                        <figure>
                            <img class="rounded-md" class="search__photo" src="@if(@isset($user->avatar)){{ Vite::asset('public/storage/image/profile/thumbnail/'. $user->avatar) }}
                                     @else
                                    {{ Vite::asset('public/storage/image/no_image.png') }}
                                    @endif"
                                 alt="Shoes"/>
                        </figure>
                    </div>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->employmentDate }}</td>
                <td> @if (\Carbon\Carbon::now()->week() % $user->shift->week == 0) первая @else вторая@endif</td>
                <td>{{ $user->position->title ?? null }}</td>
                <td>@if($user->status == 'FIRED')
                        уволен
                    @else
                        работает
                    @endif</td>
                <td>{{ $user->role }}</td>
            </tr>
        @endforeach
    </table>

@endsection
