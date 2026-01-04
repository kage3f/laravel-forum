<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with(['user', 'category'])->latest()->paginate(10);
        return response()->json($topics);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $topic = Topic::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth('api')->id(),
        ]);

        return response()->json($topic->load(['user', 'category']), 201);
    }

    public function show($uuid)
    {
        $topic = Topic::with(['user', 'category'])->where('uuid', $uuid)->firstOrFail();
        return response()->json($topic);
    }

    public function update(Request $request, $uuid)
    {
        $topic = Topic::where('uuid', $uuid)->firstOrFail();

        if ($topic->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $topic->update($request->only(['title', 'content', 'category_id']));

        return response()->json($topic->load(['user', 'category']));
    }

    public function destroy($uuid)
    {
        $topic = Topic::where('uuid', $uuid)->firstOrFail();

        if ($topic->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $topic->delete();

        return response()->json(['message' => 'Topic deleted']);
    }

    public function stats()
    {
        return response()->json([
            'topics_count' => Topic::count(),
            'users_count' => \App\Models\User::count(),
            'categories_count' => \App\Models\Category::count(),
        ]);
    }
}
