<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Program;
use App\Models\Theme;
use App\Models\User;
use App\Repositories\UserProfileRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    private UserProfileRepository $userProfileRepository;

    public function __construct(
        UserProfileRepository $userProfileRepository,
    ) {
        $this->userProfileRepository = $userProfileRepository;
    }
    public function index(): Factory|View|Application
    {
        $programs = $this->userProfileRepository->userPrograms(auth()->id());
        $favMachines = $this->userProfileRepository->favMachines(auth()->id());

        return view('public.userProfile', [
            'programs' => $programs,
            'favMachines' => $favMachines,
            'themes' => Theme::all(),
        ]);
    }

    public function update(UserProfileUpdateRequest $request, User $user, Theme $theme): RedirectResponse
    {
        $validated = $request->validated();

        $theme = $theme->findOrFail($validated['theme_id']);

        \cache(['theme_' . auth()->user()->id => $theme->title], 600);
        \cache(['theme_id_' . auth()->user()->id => $theme->id], 600);

        $user->update($validated);
        $user->save();

        return redirect()->back()->with('success', 'Профиль обновлен');
    }
}
