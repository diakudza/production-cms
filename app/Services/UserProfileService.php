<?php

namespace App\Services;

use App\Models\User;
use App\Models\Theme;

final class UserProfileService
{
    public function update(User $user, Theme $theme, array $validated): bool
    {
        $theme = $theme->findOrFail($validated['theme_id']);

        \cache(['theme_' . auth()->user()->id => $theme->title], 600);
        \cache(['theme_id_' . auth()->user()->id => $theme->id], 600);

        $user->update($validated);

        return $user->save();
    }
}
