<a href="{{ route('admin.user.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.user.index') btn-active @endif">Пользователи</a>
<a href="{{ route('admin.shift.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.shift.index') btn-active @endif">Смены</a>
<a href="{{ route('admin.position.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.position.index') btn-active @endif">Должности</a>
<a href="{{ route('admin.machine.index') }}"
   class="btn @if(request()->route()->getName() == 'admin.machine.index') btn-active @endif">Оборудование</a>
<a href="{{ route('admin.material.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.material.index') btn-active @endif">Материалы</a>
<a href="{{ route('admin.partType.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.partType.index') btn-active @endif">Типы деталей</a>
<a href="{{ route('admin.news.index') }}"
   class="btn  @if(request()->route()->getName() == 'admin.news.index') btn-active @endif">Новости</a>
