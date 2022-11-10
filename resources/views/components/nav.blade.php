<div class="navbar bg-base-100 ">
    <div class="flex-1">
        <div class="btn-group btn-group ">

            @if(request()->route()->getPrefix() == '/admin')
                @include('components.navLinkAdmin')
            @else
                @include('components.navLink')
            @endif
        </div>
    </div>

    <div class="flex-none">

        {{--        <div class="dropdown dropdown-end">--}}
        {{--            <label tabindex="0" class="btn btn-ghost btn-circle">--}}
        {{--                <div class="indicator">--}}
        {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>--}}
        {{--                    <span class="badge badge-sm indicator-item">8</span>--}}
        {{--                </div>--}}
        {{--            </label>--}}
        {{--            <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">--}}
        {{--                <div class="card-body">--}}
        {{--                    <span class="font-bold text-lg">8 Items</span>--}}
        {{--                    <span class="text-info">Subtotal: $999</span>--}}
        {{--                    <div class="card-actions">--}}
        {{--                        <button class="btn btn-primary btn-block">View cart</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        @if (auth()->check())
            <span>{{ auth()->user()->name }}</span>
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
                                <a href="{{ route('admin.index') }}">Админ Панель</a>
                            </li>
                        @endif
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
