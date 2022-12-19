@php
    use App\Models\Program;
@endphp

<a href="{{ route('home') }}" title="Главная"
   class="btn btn-sm md:btn-md gap-x-1 @if(request()->route()->getName() == 'home') btn-active @endif">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden md:inline" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    <span class=" md:hidden ">Главная</span>
</a>

<a href="{{ route('task.index') }}" class="btn btn-sm md:btn-md
@if(request()->route()->getName() == 'task.index' || request()->route()->getName() == 'task.show') btn-active @endif">Задания</a>
<a href="{{ route('search.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'search.index') btn-active @endif">Поиск по базе</a>
@auth()
    <a href="@can('create', Program::class) {{ route('program.create') }} @endcan"
       class="btn btn-sm disabled md:btn-md @if(request()->route()->getName() == 'program.create') btn-active @endif">
        <div>
            <div> Добавить новую</div>
            @cannot('create', Program::class)
                <div class="text-xs">(Вам не доступно)</div>
            @endcannot
        </div>
    </a>

    @if(auth()->user()->isAdmin())
        <a class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin') btn-active @endif"
           href="{{ route('admin.user.index') }}">Админ Панель</a>
    @endif

    <form action="{{ route('logout') }}" method="post" class="w-full ">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm md:btn-md w-full ">Выйти</button>
    </form>
@endauth

@guest()
    <a href="{{ route('loginPage') }}"
       class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'loginPage') btn-active @endif">Вход</a>
@endguest
