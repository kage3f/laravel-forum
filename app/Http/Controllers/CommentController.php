<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request, $topicUuid)
    {
        $comment = $this->commentService->createComment($topicUuid, $request->validated(), auth('api')->id());
        return response()->json($comment, 201);
    }

    public function index($topicUuid)
    {
        $comments = $this->commentService->listCommentsByTopic($topicUuid);
        return response()->json($comments);
    }
}
