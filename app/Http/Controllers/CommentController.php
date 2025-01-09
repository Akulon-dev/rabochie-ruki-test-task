<?php

namespace App\Http\Controllers;

use App\Jobs\SendComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $articleID)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        SendComment::dispatch($articleID, $request->subject, $request->body);

        return response()->json(['message' => 'Ваше сообщение успешно отправлено'], 200);
    }
}
