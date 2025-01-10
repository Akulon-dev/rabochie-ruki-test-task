<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function main(): View|Factory|Application
    {
        $articles = Article::latest()->paginate(6);
        $isPaging = false;
        return view('articles.index', compact('articles', 'isPaging'));
    }

    public function catalog(): View|Factory|Application
    {
        $articles = Article::latest()->paginate(10);
        $isPaging = true;
        return view('articles.index', compact('articles', 'isPaging'));
    }

    public function show($slug): View|Factory|Application
    {
        $article = $this->articleService->getByID($slug);
        return view('articles.show', compact('article'));
    }

    public function incrementLike($articleID): JsonResponse
    {
        $this->articleService->incLikes($articleID);

        $likeCount = request()->likeCount;
        $likeCount++;

        return response()->json(['likes' => $likeCount]);
    }

    public function incrementView($articleID): JsonResponse
    {
        $this->articleService->incViews($articleID);

        $viewCount = request()->viewCount;
        $viewCount++;
        return response()->json(['views' => $viewCount]);
    }


}
