<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $articleID;
    private string $subject;
    private string $body;

    /**
     * Create a new job instance.
     */
    public function __construct($articleID, $subject, $body)
    {
        $this->articleID = $articleID;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(600);
        // Отправка в очередь
        Comment::create([
            'article_id' => $this->articleID,
            'subject' => $this->subject,
            'body' => $this->body,
        ]);
    }
}
