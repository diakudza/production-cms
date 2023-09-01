@extends('layouts.app')

@section('title', 'Поиск')

@section('content')

    <div>

        @include('components.searchForm')

        @if(isset($result) && $result->count() && !isset($searchIndex))

            <div id="sortable" class="hidden md:grid grid-flow-col w-full mt-10 ">
                <div>Превью</div>
                <div class="w-15"><a class="jsLink" href="&sortBy=partNumber">Номер</a></div>

                <div><a class="jsLink" href="&sortBy=partType_id">Тип</a></div>
                <div><a class="jsLink" href="&sortBy=machine_id">Станок</a></div>
                <div><a class="jsLink" href="&sortBy=user_id">Автор</a></div>
                <div><a class="jsLink" href="&sortBy=material_id">Материал</a></div>
                <div>Дата добавления</div>
            </div>
            @foreach($result as $program)
                <a href="{{ route('program.show', ['program'=>$program->id]) }}">
                    <div class=" rounded-md grid grid-cols-4 hover:bg-base-300 shadow-xl md:grid-cols-7 mt-1 ">
                        <div class="w-10 md:w-16 ">
                                <img class="rounded-md h-10 md:h-16 "  src="@if(@isset($program->partPhoto)){{ Storage::url('image/programs/thumbnail/'. $program->partPhoto) }}
                                     @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"
                                     alt="Image"/>
                        </div>

                        <span class="break-all truncate" title="{{ $program->partNumber }}">
                            {{ $program->partNumber }}
                        </span>

                        <span>{{ $program->partType?->title }}</span>
                        <span>{{ $program->machine?->title }} </span>
                        <span class="hidden md:block">{{ $program->user?->name }}</span>
                        <span class="hidden md:block">
                            <div class="h-full flex gap-2">
                                @isset($program->material?->color)
                                    @include('components.materialColour' , ['color' => $program->material?->color] )
                                @endisset
                                {{ $program->material?->title }}
                            </div>
                        </span>
                        <span class="hidden md:block">{{ $program->created_at->format('Y-m-d') }}</span>

                    </div>
                </a>
            @endforeach


            <div class="mt-5">{{$result->links()}}</div>

        @elseif(isset($result) && !isset($searchIndex))
            <div class="grid justify-items-center mt-10 ">
                <p class="text-3xl">Нет результатов поиска</p>
                <p class="mt-5">Попробуйте изменить параметры запроса</p>
            </div>
        @endif

        @isset($searchIndex)
            <div class="grid justify-items-center mt-10 ">
                <p class="text-3xl ">Начните поиск</p>
                <p class="mt-5">Ищите как по отдельным столбцам, так и по их комбинациям</p>
            </div>
        @endisset
    </div>

    <script>
        const table = document.getElementById('sortable');
        const links = table.querySelectorAll('.jsLink');
        let currentUrl = location.href;
        let lastElem = currentUrl.split('&')[location.href.split('&').length - 1];

        if (lastElem.split('=')[0] == 'sortBy') {
            currentUrl = currentUrl.split('&');
            currentUrl.pop();
            currentUrl = currentUrl.join('&');
        }

        [].forEach.call(links, function (a, index) {
            a.addEventListener('click', function () {
                a.href = `${currentUrl}${a.getAttribute('href')}`;
            });
        });

    </script>
@endsection
