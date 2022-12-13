<p class="text-2xl mb-10">Рейтинг наладчиков</p>
<div class="flex gap-1 justify-center xl:gap-10 sm:gap-4 ">

    @foreach($rating as $user)
        <a href="{{ route('search.part', ['author'=>$user['user_id']]) }}" title="{{$user['name']}}">
            <div class="radial-progress text-primary flex justify-center items-center"
                 style="--value:{{ $user['rating'] }};">

                <figure>  <img class="w-24 rounded-full border"
                     src="@if(@isset($user['avatar'])){{ Storage::url('image/profile/thumbnail/'. $user['avatar']) }}
                                    @else {{ Storage::url('image/no_image.png') }}  @endif"/></figure>
                <span class="absolute indicator-item indicator-middle indicator-center badge badge-secondary">{{ $user['rating'] }}%</span>


            </div>
        </a>
        @if ($loop->iteration == 4 )
            @break
        @endif
    @endforeach
</div>
