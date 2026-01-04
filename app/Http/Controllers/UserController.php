<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(12);
        return response()->json($users);
    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'bio' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update($request->only(['name', 'bio', 'location']));

        return response()->json($user);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var User $user */
        $user = auth('api')->user();

        if ($user->avatar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = Storage::url($path);
        $user->save();

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'avatar_url' => $user->avatar
        ]);
    }
}
