<div class="navbar bg-base-100 ">
    <div class="flex-1">
        <div class="btn-group btn-group ">
            <a href="{{ route('admin.index') }}" class="btn @if(request()->route()->getName() == 'admin.index') btn-active @endif">Главная</a>
            <a href="{{ route('admin.user.index') }}"
               class="btn @if(request()->route()->getName() == 'admin.user.index') btn-active @endif">Пользователи</a>
            <a href="{{ route('admin.shift.index') }}"
                       class="btn @if(request()->route()->getName() == 'admin.shift.index') btn-active @endif">Смены</a>
            <a href="{{ route('admin.position.index') }}"
               class="btn @if(request()->route()->getName() == 'admin.position.index') btn-active @endif">Должности</a>

        </div>
    </div>

    <div class="flex-none">

        @if (auth()->user())
            <span>{{ auth()->user()->name }}</span>
        @endif
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="@if(@isset(auth()->user()->avatar)){{ Vite::asset('public/storage/image/profile/thumbnail/'. auth()->user()->avatar) }}
                                     @else
                                    {{ Vite::asset('public/storage/image/no_image.png') }}
                                    @endif"/>
                </div>
            </label>
            <ul tabindex="0"
                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box border w-70">

                <li>
                    <a href="{{ route('home') }}">НА сайт</a>
                </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn">Выйти</button>
                        </form>
                    </li>


            </ul>
        </div>
    </div>
</div>
