<?php

namespace App\Actions;

use App\Models\Program;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchAction
{
    public function __invoke($query): LengthAwarePaginator
    {
        $partNumber = $query['partNumber'] ?? NULL;
        $machine = $query['machine_id'] ?? NULL;
        $author = $query['author'] ?? NULL;
        $partType = $query['partType'] ?? NULL;
        $itemOnPage = $query['itemOnPage'] ?? 20;
        $sortBy = $query['sortBy'] ?? NULL;

        $programs = (new Program())
            ->when($partNumber, function ($query, $partNumber) {
                $query->where('partNumber', 'LIKE', '%' . $partNumber . '%');
            })
            ->when($machine, function ($query, $machine) {
                $query->where('machine_id', $machine);
            })
            ->when($author, function ($query, $author) {
                $query->where('user_id', $author);
            })
            ->when($partType, function ($query, $partType) {
                $query->where('partType_id', $partType);
            })
            ->when($sortBy, function ($query, $sortBy) {
                $query->OrderBy($sortBy);
            })
            ->with('user')
            ->with('partType')
            ->with('material')
            ->with('machine')
            ->paginate($itemOnPage)
            ->withQueryString();

        return $programs;
    }
}
