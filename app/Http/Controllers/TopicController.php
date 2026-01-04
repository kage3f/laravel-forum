<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\StoreTopicRequest;
use App\Http\Requests\Topic\UpdateTopicRequest;
use App\Services\TopicService;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function index(Request $request)
    {
        $topics = $this->topicService->listTopics($request->all());
        return response()->json($topics);
    }

    public function store(StoreTopicRequest $request)
    {
        $topic = $this->topicService->createTopic($request->validated(), auth('api')->id());
        return response()->json($topic, 201);
    }

    public function show($uuid)
    {
        $topic = $this->topicService->getTopicByUuid($uuid);
        return response()->json($topic);
    }

    public function update(UpdateTopicRequest $request, $uuid)
    {
        $topic = $this->topicService->updateTopic($uuid, $request->validated(), auth('api')->id());

        if ($topic === null) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($topic);
    }

    public function destroy($uuid)
    {
        $deleted = $this->topicService->deleteTopic($uuid, auth('api')->id());

        if (!$deleted) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Topic deleted']);
    }

    public function stats()
    {
        return response()->json($this->topicService->getStats());
    }
}
