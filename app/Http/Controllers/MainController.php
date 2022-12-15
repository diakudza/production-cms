<?php

namespace App\Http\Controllers;

use App\Helpers\RatingHelper;
use App\Models\News;
use App\Models\Program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function __invoke(Program $program, RatingHelper $rating): Factory|View|Application
    {
        return view('public.index', [
            'programs' => $program->getLastPrograms(10),
            'news' => News::with('user')->OrderBy('created_at', 'DESC')->limit(4)->get(),
            'rating' => $rating->list
        ]);

    }
}
