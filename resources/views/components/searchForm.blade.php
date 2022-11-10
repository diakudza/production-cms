<form action="{{route('search.part')}}" class="card w-full bg-base-100 shadow-xl">
    <div class="grid grid-cols-6 gap-4 p-2">
        <input type="text" placeholder="Номер детали" name="partNumber" class="input input-bordered w-full max-w-xs"
               value="{{ $searchPartNumber ?? NULL}}"/>
        <select class="select select-bordered max-w-xs" name="machine_id">
            <option disabled selected>По станоку</option>
            <option value="">Не учитывать</option>
            @foreach ($machines as $machine)
                <option value="{{ $machine->id }}" @isset($searchMachine)
                    @selected($searchMachine == $machine->id)
                    @endisset>{{ $machine->title }}</option>
            @endforeach
        </select>

        <select class="select select-bordered max-w-xs" name="author">
            <option disabled selected>По автору</option>
            <option value="">Не учитывать</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @isset($searchAuthor)
                    @selected($searchAuthor == $author->id)
                    @endisset>{{ $author->name }}</option>
            @endforeach
        </select>

        <select class="select select-bordered max-w-xs" name="partType">
            <option disabled selected>По тип</option>
            <option value="">Не учитывать</option>
            @foreach($partTypes as $partType)
                <option value="{{ $partType->id }}" @isset($searchPartType)
                    @selected($searchPartType == $partType->id)
                    @endisset>{{ $partType->title }}</option>
            @endforeach
        </select>

        <select class="select select-bordered max-w-xs" name="itemOnPage">
            <option disabled selected>Выводить по</option>
            @for($count = 10; $count <= 150; $count += 20)
                <option value="{{ $count }}" @isset($searchitemOnPage)
                    @selected($searchitemOnPage == $count )
                    @endisset>{{ $count }}</option>
            @endfor
        </select>
        <div class="grid grid-cols-2 gap-2">
            <button type="submit" class="btn gap-2 w-fu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
            <a href="{{ route('search.index') }}" class="btn  w-18">
                Сброс
            </a>
        </div>
    </div>
</form>
