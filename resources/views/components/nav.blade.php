<div class="navbar bg-base-100">
    <div class="flex-1">
        <div class="dropdown absolute w-full md:hidden sm:block">
            <label tabindex="0" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
            </label>
            <ul tabindex="0"
                class="menu  dropdown-content mt-3 w-[96%] absolute bg-base-100 gap-2 pb-3 pr-3">
                @if(request()->route()->getPrefix() == '/admin')
                    @include('components.navLinkAdmin')
                @else
                    @include('components.navLink')
                @endif
            </ul>
        </div>
        <div class="btn-group btn-group-horizontal hidden md:flex">
            @if(request()->route()->getPrefix() == '/admin')
                @include('components.navLinkAdmin')
            @else
                @include('components.navLink')
            @endif
        </div>
    </div>

    <div>
        @if (auth()->check())
            <a href="{{ route('user.index') }}">
                <span class="">{{ auth()->user()->name }}</span>
            </a>
            <a href="{{ route('user.index') }}">
                <img class="w-10 rounded-full" src="
        @if(@isset(auth()->user()->avatar))
            {{ Storage::url('image/profile/thumbnail/'. auth()->user()->avatar) }}
        @else {{ Storage::url('image/no_image.png') }} @endif"/>
            </a>
        @else
            <span>Гость</span><img class="w-10 rounded-full" src="{{ Storage::url('image/no_image.png') }}"/>
        @endif

    </div>

</div>
