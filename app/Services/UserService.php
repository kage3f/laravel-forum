<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function listUsers()
    {
        return User::latest()->paginate(12);
    }

    public function getUserByUsername($username)
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function updateProfile(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function uploadAvatar(User $user, $file)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
        }

        $path = $file->store('avatars', 'public');
        $user->avatar = Storage::url($path);
        $user->save();

        return $user->avatar;
    }
}
