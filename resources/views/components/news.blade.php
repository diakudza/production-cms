


    @forelse ($news as $singleNews)

        @if(auth()->check() && auth()->user()->can('update', $singleNews))<a href="{{ route('news.edit', $singleNews->id) }}">@endif

        <div class="mb-5 mt-5">
            <div class="indicator">
                @if(request()->route()->getPrefix() == '/admin')
                    <span class="indicator-item indicator-top indicator-start badge badge-secondary"> @if($singleNews->public)
                            puplic
                        @else
                            private
                        @endif</span>
                @endif
                <p class="text-xl">{{ $singleNews->title }}</p>
            </div>
            <div class="w-full">{{ $singleNews->text }}</div>
            <div>{{ $singleNews->user->name }} {{ $singleNews->created_at->format('Y-m-d') }}</div>
        </div>
        </a>
    @empty
        <div>Пока еще нет новостей!</div>
    @endforelse

