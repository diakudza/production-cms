@php
    use App\Models\Program;
@endphp

<a href="{{ route('home') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'home') btn-active @endif">Главная</a>
<a href="{{ route('task.index') }}" class="btn btn-sm md:btn-md
@if(request()->route()->getName() == 'task.index' || request()->route()->getName() == 'task.show') btn-active @endif">Задания</a>
<a href="{{ route('search.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'search.index') btn-active @endif">Поиск по базе</a>
@auth()

    <a href="@can('create', Program::class) {{ route('program.create') }} @endcan"
       class="btn btn-sm md:btn-md disabled @if(request()->route()->getName() == 'program.create') btn-active @endif">
        <div>
            <div> Добавить новую</div>
            @cannot('create', Program::class)<div class="text-xs">(Вам не доступно)</div>@endcannot
        </div>
    </a>

@endauth
