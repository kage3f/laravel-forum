<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $topicUuid)
    {
        $topic = Topic::where('uuid', $topicUuid)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth('api')->id(),
            'topic_id' => $topic->id,
        ]);

        return response()->json($comment->load('user'), 201);
    }

    public function index($topicUuid)
    {
        $topic = Topic::where('uuid', $topicUuid)->firstOrFail();
        $comments = $topic->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }
}
