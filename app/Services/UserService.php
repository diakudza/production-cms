<?php

namespace App\Services;

use App\Models\User;
use App\Actions\ImageAction;

final class UserService
{
    private ImageAction $imageAction;

    public function __construct(ImageAction $imageAction)
    {
        $this->imageAction = $imageAction;
    }

    public function store(User $user, array $validated): bool
    {
        $imageAction = $this->imageAction;
        if (isset($validated['avatar'])) {
            $validated['avatar'] = $imageAction($validated['avatar'], 'profile', 400, 400);
        }
        $validated['password'] = bcrypt($validated['password']);
        $user->fill($validated);

        return $user->save();
    }

    public function update(User $user, array $validated): bool
    {
        $imageAction = $this->imageAction;
        if (isset($validated['avatar'])) {
            $validated['avatar'] = $imageAction($validated['avatar'], 'profile', 400, 400);
        }
        if (isset($validated['avatarDelete'])) {
            $validated['avatar'] = null;
        }
        $user->update($validated);
        return $user->save();
    }
}
