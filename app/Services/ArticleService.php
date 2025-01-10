<?php

namespace App\Services;

use App\Jobs\IncrementLikeCount;
use App\Jobs\IncrementViewCount;
use App\Models\Article;

class ArticleService
{
    public function getByID($slug)
    {
        return Article::where('id', $slug)->firstOrFail();
    }

    public function incLikes($articleID): void
    {
        IncrementLikeCount::dispatch($articleID);
    }

    public function incViews($articleID): void
    {
        IncrementViewCount::dispatch($articleID);
    }
}
