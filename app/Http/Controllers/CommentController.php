<?php

namespace App\Http\Controllers;

use App\Jobs\SendComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function store($articleID): JsonResponse
    {
        request()->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        SendComment::dispatch($articleID, request()->subject, request()->body);

        return response()->json(['message' => 'Ваше сообщение успешно отправлено']);
    }
}
