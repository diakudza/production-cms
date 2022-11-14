
<select
    name="{{ $attributes->get('name') }}"
    class="select select-bordered @error($attributes->get('name')) select-error @enderror"
    placeholder="{{ $attributes->get('title') }}"
    title="{{ $attributes->get('title') }}"
>
    {{$slot}}
</select>
