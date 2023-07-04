<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Position;
use App\Models\Program;
use App\Models\Shift;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private readonly UserRepository $userRepository;
    private readonly UserService $userService;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService,
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }
    public function index()
    {
        $user =  $this->userRepository->getUsers();

        return view('admin.users.usersList', ['users' => $user]);
    }

    public function create()
    {
        return view('admin.users.userAdd', [
            'shifts' => Shift::all(),
            'positions' => Position::all(),
        ]);
    }

    public function store(UserStoreRequest $request, User $user)
    {

        $this->userService->store($user, $request->validated());

        return redirect()->route('admin.user.show', $user->id)->with('success', "Пользователь $user->name успешно добавлен");
    }

    public function show(User $user)
    {
        $programs = $this->userRepository->userPrograms($user->id);

        $lastLogin = $this->userRepository->lastLogins($user);

        return view('admin.users.userSingle', [
            'user' => $user,
            'shifts' => Shift::all(),
            'positions' => Position::all(),
            'programs' => $programs,
            'lastLogin' => $lastLogin
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, ImageAction $imageAction)
    {
        $validated = $request->validated();

        if (isset($validated['avatar'])) {
            $validated['avatar'] = $imageAction($validated['avatar'], 'profile', 400, 400);
        }
        if (isset($validated['avatarDelete'])) {
            $validated['avatar'] = null;
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
