<select class="select select-bordered md:w-full" name="{{ $name }}">
    <option disabled selected>{{ $placeholder }}</option>
    <option value="0">Не учитывать</option>
    @foreach ($list as $item)
        <option value="{{ $item->id }}"@selected(request($name) == $item->id)>{{ $item->title ?? $item->name }}</option>
    @endforeach
</select>