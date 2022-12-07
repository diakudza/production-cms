<?php

namespace App\Http\Controllers;

use App\Actions\SearchAction;
use App\Http\Requests\SearchProgramRequest;
use App\Models\Machine;
use App\Models\PartType;
use App\Models\Program;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public const AUTHOR = null;

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
