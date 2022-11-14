@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
    <a class="btn gap-2" href="{{ route('admin.user.create') }}">Новый пользователь</a>

    <table class="table table-zebra mt-5">

        <th>Таб. ном.</th>
        <th>Фото</th>
        <th>Фио</th>
        <th>Дата добавления</th>
        <th>На этой недели</th>
        <th>Должность</th>
        <th>Статус</th>
        <th>Роль</th>


        @foreach($users as $user)

            <tr>
                <td>
                    <a href="{{ route('admin.user.show', $user->id) }}">
                        {{ $user->tabNumber }}
                    </a>
                </td>
                <td>
                    <div class="w-20">
                        <figure>
                            <img class="rounded-md" class="search__photo" src="@if(@isset($user->avatar)){{ Storage::url('image/profile/thumbnail/'. $user->avatar) }}
                                    @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                                 alt="UserPhoto"/>
                        </figure>
                    </div>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->employmentDate }}</td>
                <td> @if (\Carbon\Carbon::now()->week() % 2 != $user->shift->week)
                        первая
                    @else
                        вторая
                    @endif</td>
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
