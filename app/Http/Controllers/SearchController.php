<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Machine;
use App\Models\PartType;
use App\Actions\SearchAction;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\SearchProgramRequest;
use Illuminate\Contracts\Foundation\Application;


final class SearchController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('public.search', [
            'authors' => (new User)->getAdjusterOnly(),
            'machines' => Machine::all(),
            'partTypes' => PartType::all(),
            'searchIndex' => true,
        ]);
    }

    public function search(SearchProgramRequest $request, SearchAction $search): Factory|View|Application
    {
        return view('public.search', [
            'result' => $search($request->validated()),
            'authors' => (new User)->getAdjusterOnly(),
            'machines' => Machine::all(),
            'partTypes' => PartType::all(),
        ]);
    }
}
