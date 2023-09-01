<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class NewsRepository
{
    public function getLastNews(int $count): Collection|array
    {
        return Cache::remember('last_news_' . $count, 1800, function () use ($count) {
            return News::query()
                ->with('user')
                ->OrderBy('created_at', 'DESC')
                ->limit($count)
                ->get();
        });
    }

}
