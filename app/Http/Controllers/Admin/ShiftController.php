<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Shift;
use App\Services\ShiftService;
use App\Http\Controllers\Controller;
use App\Repositories\ShiftRepository;
use App\Http\Requests\Admin\ShiftStoreRequest;
use App\Http\Requests\Admin\ShiftUpdateRequest;

final class ShiftController extends Controller
{
    private readonly ShiftRepository $shiftRepository;
    private readonly ShiftService $shiftService;

    public function __construct(
        ShiftRepository $shiftRepository,
        ShiftService $shiftService,
    ) {
        $this->shiftRepository = $shiftRepository;
        $this->shiftService = $shiftService;
    }

    public function index()
    {
        return view('admin.shift', [
            'shifts' => $this->shiftRepository->getShiftsWithUsers(),
        ]);
    }

    public function store(ShiftStoreRequest $request, Shift $shift)
    {
        $this->shiftService->store($shift, $request->validated());
        return redirect()->back()->with('success', 'Смена добавлена!');
    }

    public function update(ShiftUpdateRequest $request, Shift $shift)
    {
        $this->shiftService->update($shift, $request->validated());
        return redirect()->back()->with('success', 'Смена обновлена!');
    }

    /**
     * @throws Throwable
     */
    public function destroy(Shift $shift)
    {
        $shift->deleteOrFail();
        return redirect()->back()->with('success', 'Смена удалена!');
    }

}
