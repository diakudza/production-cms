<?php

namespace App\Helpers;


use App\Models\Program;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class RatingHelper
{
    public array|Collection $query;
    public array $list = [];

    public function __construct()
    {
        $this->query = $this->getQuery();
        $this->makeFillList();
    }

    public function getQuery(): Collection|array
    {
        return Cache::remember('top_programs', 1800, function () {
            return Program::query()
                ->join('users', 'users.id', '=', 'programs.user_id')
                ->selectRaw('count(user_id) as count, users.name, users.avatar, user_id')
                ->groupBy('user_id')
                ->orderByDesc('count')
                ->get();
        });
    }

    public function makeFillList(): void
    {
        foreach ($this->query as $item) {
            $this->list[] = [
                'name' => $item->name,
                'rating' => round($item->count * 100 / $this->getProgramCount()),
                'avatar' => $item->avatar,
                'user_id' => $item->user_id,
            ];
        }
    }

    public function getProgramCount()
    {
        if (Cache::has('ProgramCount') && Cache::get('ProgramCount') != 0) {
            return Cache::get('ProgramCount');
        }
        Cache::remember('ProgramCount', 10, function () {
            return Program::query()->get()->count();
        });

        return Cache::get('ProgramCount');
    }
}
