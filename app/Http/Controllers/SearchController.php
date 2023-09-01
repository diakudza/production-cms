<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\Factory;
use App\Repositories\ProgramRepository;
use App\Repositories\PartTypeRepository;
use App\Repositories\MaterialRepository;
use App\Http\Requests\SearchProgramRequest;
use Illuminate\Contracts\Foundation\Application;


final class SearchController extends Controller
{
    public function __construct(
        private readonly ProgramRepository $programRepository,
        private readonly PartTypeRepository $partTypeRepository,
        private readonly MaterialRepository $materialRepository,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function index(): Factory|View|Application
    {
        $filters = $this->programRepository->getFiltersForSearch();
        $authors = $this->userRepository->getAdjusterOnly();
        $partTypes = $this->partTypeRepository->getAllPartType();
        $materials = $this->materialRepository->getAllMaterial();
        $searchIndex = true;

        return view('public.search', compact('filters', 'authors', 'partTypes', 'materials', 'searchIndex'));
    }

    public function search(SearchProgramRequest $request): Factory|View|Application
    {
        return view(
            'public.search',
            [
                'result' => $this->programRepository->getFilteredPrograms($request->get('itemOnPage')),
                'filters' => $this->programRepository->getFiltersForSearch(),
            ]
        );
    }
}
