<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        if (auth()->check()) {
            $theme = Cache::remember('theme_' . auth()->user()->id, 600, function () {
                return auth()->user()->theme->title;
            });
            $view->with('globalTheme', $theme);
        } else {
            $view->with('globalTheme', 'halloween');
        }

    }
}
