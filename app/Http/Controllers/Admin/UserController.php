<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.usersList', [
            'users' => User::with('shift', 'position')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.userAdd', [
            'shifts' => Shift::all(),
            'positions' => Position::all(),
        ]);
    }

    public function store(UserStoreRequest $request, User $user, ImageAction $imageAction)
    {
        $validated = $request->validated();

        if (isset($validated['avatar'])) {
            $validated['avatar'] = $imageAction($validated['avatar'], 'profile', 400, 400);
        }
        $validated['password'] = bcrypt($validated['password']);
        $user->fill($validated);
        $user->save();
        return redirect()->route('admin.user.show', $user->id)->with('success', "Пользователь $user->name успешно добавлен");
    }

    public function show(User $user)
    {
        return view('admin.userSingle', [
            'user' => $user,
            'shifts' => Shift::all(),
            'positions' => Position::all(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, ImageAction $imageAction)
    {
        $validated = $request->validated();

        if (isset($validated['avatar'])) {
            $validated['avatar'] = $imageAction($validated['avatar'], 'profile', 400, 400);
        }
        $user->update($validated);
        $user->save();
        return redirect()->back()->with('success', 'Пользователь обновлен!');
    }

    public function destroy(User $user)
    {
        \Log::info('TEST');
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Пользователь успешно удален');
    }

}
