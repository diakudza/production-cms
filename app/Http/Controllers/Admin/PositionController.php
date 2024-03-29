<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Position;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PositionStoreRequest;

final class PositionController extends Controller
{

    public function index()
    {
        return view('admin.position', [
            'positions' => Position::with('users')->get(),
        ]);
    }

    public function store(PositionStoreRequest $request, Position $position)
    {
        $position->fill($request->validated());
        $position->save();
        return redirect()->back()->with('success', 'Должность добавлена!');
    }

    public function update(PositionStoreRequest $request, Position $position)
    {
        $position->update($request->validated());
        $position->save();
        return redirect()->back()->with('success', 'Должность обновлена!');
    }

    /**
     * @throws Throwable
     */
    public function destroy(Position $position)
    {
        $position->deleteOrFail();
        return redirect()->back()->with('success', 'Должность удалена!');
    }
}
