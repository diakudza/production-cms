<input type="checkbox" id="my-modal" class="modal-toggle"/>
<div class="modal">
    <div class="modal-box relative">
        <label for="my-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <h3 class="text-lg font-bold">{{ $message }}</h3>
        <form action="{{ route($route, $id) }}" class="flex flex-col mt-10 justify-center" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-error">Удалить</button>
            <p class="py-4">Нажмите удалить или закройте окно.</p>
        </form>
    </div>
</div>
