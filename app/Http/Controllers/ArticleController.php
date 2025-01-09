<?php

namespace App\Http\Controllers;

use App\Jobs\IncrementLikeCount;
use App\Jobs\IncrementViewCount;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function main()
    {
        $articles = Article::latest()->paginate(6);
        $isPaging = false;
        return view('articles.index', compact('articles', 'isPaging'));
    }

    public function catalog()
    {
        $articles = Article::latest()->paginate(10);
        $isPaging = true;
        return view('articles.index', compact('articles', 'isPaging'));
    }

    public function show($slug)
    {
        $article = Article::where('id', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function incrementLike($articleID)
    {
        IncrementLikeCount::dispatch($articleID);
        $likeCount = request()->likeCount;
        $likeCount++;
        return response()->json(['likes' => $likeCount]);
    }

    public function incrementView($articleID)
    {
        // Отправляем задачу в очередь
        IncrementViewCount::dispatch($articleID);
        // Не стоит нагружать БД, просто увеличим число из запроса
        $viewCount = request()->viewCount;
        $viewCount++;
        return response()->json(['views' => $viewCount]);
    }


}
