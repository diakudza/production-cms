<?php

namespace App\Services;

use App\Models\News;

final class NewsService
{
    public function store(News $news, array $validated): bool
    {
        $news->fill($validated);

        return $news->save();
    }

    public function update(News $news, array $validated): bool
    {
        $validated['public'] = $validated['public'] ?? 0;
        $news->update($validated);

        return $news->save();
    }
}
