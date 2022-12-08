<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function __invoke(Program $program): Factory|View|Application
    {
        return view('public.index', [
            'programs' => $program->getLastPrograms(10),
            'news' => News::with('user')->limit(10)->get(),
        ]);

    }
}
