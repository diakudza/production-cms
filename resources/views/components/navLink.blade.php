<a href="{{ route('home') }}" class="btn @if(request()->route()->getName() == 'home') btn-active @endif">Главная</a>
<a href="{{ route('search.index') }}"
   class="btn @if(request()->route()->getName() == 'search.index') btn-active @endif">Поиск по базе</a>
@auth()
    @can('create', \App\Models\Program::class)
        <a href="{{ route('program.create') }}"
           class="btn @if(request()->route()->getName() == 'program.create') btn-active @endif">Добавить новую</a>
    @endcan
@endauth
