<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Topic;

class CommentService
{
    public function listCommentsByTopic($topicUuid)
    {
        $topic = Topic::where('uuid', $topicUuid)->firstOrFail();
        return $topic->comments()->with('user')->latest()->get();
    }

    public function createComment($topicUuid, array $data, $userId)
    {
        $topic = Topic::where('uuid', $topicUuid)->firstOrFail();

        return Comment::create([
            'content' => $data['content'],
            'user_id' => $userId,
            'topic_id' => $topic->id,
        ])->load('user');
    }
}
