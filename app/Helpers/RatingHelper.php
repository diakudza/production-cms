<?php

namespace App\Helpers;


use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

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
        $query = Program::query()
            ->join('users', 'users.id', '=', 'programs.user_id')
            ->selectRaw('count(user_id) as count, users.name, users.avatar, user_id')
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->get();
        return $query;
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
        Cache::remember('ProgramCount', 1000, function () {
            return Program::query()->get()->count();
        });
    }
}
