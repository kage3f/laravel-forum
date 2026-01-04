<?php

namespace App\Services;

use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class TopicService
{
    public function listTopics(array $filters)
    {
        $query = Topic::with(['user', 'category'])->withCount('comments');

        if (isset($filters['category_id']) && $filters['category_id']) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['search']) && $filters['search']) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (isset($filters['sort']) && $filters['sort'] === 'populares') {
            $query->orderBy('comments_count', 'desc');
        } else {
            $query->latest();
        }

        return $query->paginate(10);
    }

    public function createTopic(array $data, $userId)
    {
        return Topic::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'user_id' => $userId,
        ])->load(['user', 'category']);
    }

    public function getTopicByUuid($uuid)
    {
        return Topic::with(['user', 'category'])->where('uuid', $uuid)->firstOrFail();
    }

    public function updateTopic($uuid, array $data, $userId)
    {
        $topic = Topic::where('uuid', $uuid)->firstOrFail();

        if ($topic->user_id !== $userId) {
            return null;
        }

        $topic->update($data);

        return $topic->load(['user', 'category']);
    }

    public function deleteTopic($uuid, $userId)
    {
        $topic = Topic::where('uuid', $uuid)->firstOrFail();

        if ($topic->user_id !== $userId) {
            return false;
        }

        return $topic->delete();
    }

    public function getStats()
    {
        return [
            'topics_count' => Topic::count(),
            'users_count' => User::count(),
            'categories_count' => Category::count(),
        ];
    }
}
