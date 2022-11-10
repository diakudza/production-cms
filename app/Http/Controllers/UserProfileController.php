<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Program;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserProfileController extends Controller
{

    public function index()
    {
        $programs = Program::with(['user', 'machine'])
            ->whereRelation('user', 'id', '=', auth()->user()->id)
            ->get();
        return view('public.userProfile', [
            'programs' => $programs,
            'themes' => Theme::all(),
        ]);
    }

    public function update(UserProfileUpdateRequest $request, User $user, Theme $theme)
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
