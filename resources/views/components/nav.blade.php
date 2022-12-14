<div class="navbar bg-base-100">
    <div class="flex-1">
        <div class="dropdown  md:hidden sm:block">
            <label tabindex="0" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </label>
            <ul tabindex="0" class="menu menu-compact border dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                @include('components.navLink')
            </ul>
        </div>
{{--    </div>--}}
        <div class=" btn-group btn-group-horizontal hidden md:flex">
            @if(request()->route()->getPrefix() == '/admin')
                @include('components.navLinkAdmin')
            @else
                @include('components.navLink')
            @endif
        </div>
    </div>

    @guest
        <div class="hidden lg:block ">
            <span>В гостевом доступе доступен только поиск и просмотр программ. Залогиньтесь -> </span>
        </div>
    @endguest
    <div class="flex-none">
        @if (auth()->check())
            <span class="hidden md:block">{{ auth()->user()->name }}</span>
        @endif

        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="@if(@isset(auth()->user()->avatar)){{ Storage::url('image/profile/thumbnail/'. auth()->user()->avatar) }}
                                     @else
                                    {{ Storage::url('image/no_image.png') }}
                                    @endif"/>
                </div>
            </label>
            <ul tabindex="0"
                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box border w-52">
                @auth()
                    <li>
                        <a href="{{ route('user.index') }}">
                            Ваш профиль
                        </a>
                    </li>
                    {{--                <li><a>Settings</a></li>--}}

                    @if(auth()->user()->isAdmin())
                        @if(request()->route()->getPrefix() == '/admin')
                            <li>
                                <a href="{{ route('home') }}">На сайт</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('admin.user.index') }}">Админ Панель</a>
                            </li>
                        @endif
                            <li>
                                <a href="{{ route('admin.log') }}">Статистика</a>
                            </li>
                    @endif

                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn w-full btn-sm">Выйти</button>
                        </form>
                    </li>
                @elseguest()
                    <form action="{{ route('login') }}" method="post" class="p-5 flex flex-col gap-4">
                        @csrf
                        <input type="text" name="tabNumber"
                               class="input input-bordered w-full @error('tabNumber') input-error @enderror"
                               placeholder="Таб. номер">
                        <input type="password" name="password"
                               class="input input-bordered w-full max-w-xs @error('tabNumber') input-error @enderror"
                               placeholder="Пароль">
                        <button class="btn">Войти</button>
                    </form>
                @endauth

            </ul>
        </div>
    </div>

</div>
