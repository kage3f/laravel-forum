<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return compact('user', 'token');
    }

    public function login(array $credentials)
    {
        $authCredentials = [];
        if (filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
            $authCredentials = ['email' => $credentials['email'], 'password' => $credentials['password']];
        } else {
            $authCredentials = ['username' => $credentials['email'], 'password' => $credentials['password']];
        }

        if (!$token = auth('api')->attempt($authCredentials)) {
            return null;
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ];
    }
}
