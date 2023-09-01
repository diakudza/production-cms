@php
    $color = explode(',',$color);
    $class = $class ?? 5;
@endphp

@if(count($color) > 1)
    <div class="{{$class}} rounded-md h-full"
         style="background: linear-gradient(180deg, {{ $color[0] }} 50%, {{ $color[1] }} 50%); opacity: 50%">.
    </div>
@else
    <div class="{{$class}} rounded-md h-full" style="background: {{ $color[0] }} ; opacity: 50%">.</div>
@endif
