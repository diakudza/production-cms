<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

final class NewsRepository
{
    public function getLastNews(int $count): Collection|array
    {
        return News::query()
            ->with('user')
            ->OrderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

}
