<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MachineStoreRequest;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        return view('public.news', [
            'news' => News::with('user')->get(),
        ]);
    }

    public function edit(News $news)
    {
        return view('news.newsEdit', ['news' => $news]);
    }

    public function create(News $news)
    {
        return view('news.newsAdd');
    }
    public function store(NewsStoreRequest $request, News $news)
    {
        $news->fill($request->validated());
        $news->save();
        return redirect()->back()->with('success', 'Новость добавлена!');
    }

    public function update(NewsStoreRequest $request, News $news)
    {
        $validated = $request->validated();
        $validated['public'] = $validated['public'] ?? 0;
        $news->update($validated);
        $news->save();
        return redirect()->back()->with('success', 'Новость обновлена!');
    }

    public function destroy(News $news)
    {
        $news->deleteOrFail();
        return redirect()->back()->with('success', 'Новость удалена!');
    }
}
