<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Contracts\View\View;
use App\Services\UserProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Repositories\UserProfileRepository;
use App\Http\Requests\UserProfileUpdateRequest;
use Illuminate\Contracts\Foundation\Application;

final class UserProfileController extends Controller
{
    private UserProfileRepository $userProfileRepository;
    private UserProfileService $userProfileService;

    public function __construct(
        UserProfileRepository $userProfileRepository,
        UserProfileService $userProfileService
    ) {
        $this->userProfileRepository = $userProfileRepository;
        $this->userProfileService = $userProfileService;
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
        $this->userProfileService->update($user,$theme, $request->validated());
        return redirect()->back()->with('success', 'Профиль обновлен');
    }
}
