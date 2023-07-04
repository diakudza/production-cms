<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Helpers\RatingHelper;
use Illuminate\Contracts\View\View;
use App\Repositories\NewsRepository;
use Illuminate\Contracts\View\Factory;
use App\Repositories\ProgramRepository;
use Illuminate\Contracts\Foundation\Application;

class MainController extends Controller
{
    private readonly NewsRepository $newsRepository;
    private readonly ProgramRepository $programRepository;

    public function __construct(
        NewsRepository $newsRepository,
        ProgramRepository $programRepository
    ) {
        $this->newsRepository = $newsRepository;
        $this->programRepository = $programRepository;
    }

    public function __invoke(Program $program, RatingHelper $rating): Factory|View|Application
    {
        return view('public.index', [
            'programs' => $this->programRepository->getLastPrograms(10),
            'news' => $this->newsRepository->getLastNews(4),
            'rating' => $rating->list
        ]);
    }
}
