<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\News;
use App\Services\NewsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsStoreRequest;

final class NewsController extends Controller
{
    private readonly NewsService $newsService;

    public function __construct(
        NewsService $newsService,
    ) {
        $this->newsService = $newsService;
    }

    public function index()
    {
        return view('public.news', [
            'news' => News::with('user')->get(),
        ]);
    }

    public function edit(News $news)
    {
        return view('admin.news.newsEdit', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.news.newsAdd');
    }

    public function store(NewsStoreRequest $request, News $news)
    {
        $this->newsService->store($news, $request->validated());
        return redirect()->back()->with('success', 'Новость добавлена!');
    }

    public function update(NewsStoreRequest $request, News $news)
    {
        $this->newsService->update($news, $request->validated());
        return redirect()->back()->with('success', 'Новость обновлена!');
    }

    /**
     * @throws Throwable
     */
    public function destroy(News $news)
    {
        $news->deleteOrFail();
        return redirect()->back()->with('success', 'Новость удалена!');
    }
}
