<div class="pl-3 tabs ">
    <a href="{{ route('task.show', 'active') }}"
       class="tab tab-lifted  @if(request()->route()->parameters['task'] == 'active') tab-active @endif">Активные</a>
    <a href="{{ route('task.show', 'arhived') }}"
       class="tab tab-lifted @if(request()->route()->parameters['task'] == 'arhived') tab-active @endif">Законченные</a>
</div>
