<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShiftStoreRequest;
use App\Http\Requests\Admin\ShiftUpdateRequest;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function index()
    {
        return view('admin.shift', [
            'shifts' => Shift::with('users')->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(ShiftStoreRequest $request, Shift $shift)
    {
        $validated = $request->validated();
        $shift->fill($validated);
        $shift->save();
        return redirect()->back()->with('success', 'Смена добавлена!');
    }

    public function update(ShiftUpdateRequest $request, Shift $shift)
    {
        $validated = $request->validated();
        $validated['week'] = $validated['week'] ?? 0;
        $shift->update($validated);
        $shift->save();
        return redirect()->back()->with('saccess', 'Смена обновлена!');
    }

    public function destroy($id)
    {
        //
    }
}
