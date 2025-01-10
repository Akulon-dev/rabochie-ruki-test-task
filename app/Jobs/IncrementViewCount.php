<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementViewCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $articleId;

    public function __construct($articleId)
    {
        $this->articleId = $articleId;
    }

    public function handle(): void
    {
        $article = Article::findOrFail($this->articleId);
        $article->increment('views');
    }
}
