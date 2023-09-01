<a href="{{ route('home') }}" title="Главная"
   class="btn btn-sm md:btn-md gap-x-1 @if(request()->route()->getName() == 'home') btn-active @endif">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden md:inline" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    <span class=" md:hidden ">Главная</span>
</a>
<a href="{{ route('admin.user.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.user.index') btn-active @endif">Поль.</a>
<a href="{{ route('admin.shift.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.shift.index') btn-active @endif">Смены</a>
<a href="{{ route('admin.position.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.position.index') btn-active @endif">Должности</a>
<a href="{{ route('admin.machine.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.machine.index') btn-active @endif">Станки</a>
<a href="{{ route('admin.material.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.material.index') btn-active @endif">Мат.</a>
<a href="{{ route('admin.partType.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'admin.partType.index') btn-active @endif">Типы
    деталей</a>
<a href="{{ route('news.index') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'news.index') btn-active @endif">Новости</a>
<a href="{{ route('admin.log') }}"
   class="btn btn-sm md:btn-md @if(request()->route()->getName() == 'log') btn-active @endif">Статистика</a>
<form action="{{ route('logout') }}" method="post" class="w-full ">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm md:btn-md w-full ">Выйти</button>
</form>
