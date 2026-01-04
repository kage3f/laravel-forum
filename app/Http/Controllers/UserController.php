<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UploadAvatarRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->listUsers();
        return response()->json($users);
    }

    public function show($username)
    {
        $user = $this->userService->getUserByUsername($username);
        return response()->json($user);
    }

    public function update(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = auth('api')->user();

        $updatedUser = $this->userService->updateProfile($user, $request->validated());

        return response()->json($updatedUser);
    }

    public function uploadAvatar(UploadAvatarRequest $request)
    {
        /** @var User $user */
        $user = auth('api')->user();

        $avatarUrl = $this->userService->uploadAvatar($user, $request->file('avatar'));

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'avatar_url' => $avatarUrl
        ]);
    }
}
