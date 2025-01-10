<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementLikeCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $articleID;

    public function __construct($articleID)
    {
        $this->articleID = $articleID;
    }

    public function handle(): void
    {
        $article = Article::findOrFail($this->articleID);
        $article->increment('likes');
    }
}
