<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Models\RefreshToken;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class Login
{
    public function __invoke($root, array $args)
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password'],
        ];

        if (!$token = JWTAuth::attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        $user = auth()->user();
        $refreshToken = bin2hex(random_bytes(32));
        RefreshToken::create([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'expires_at' => now()->addDays(7),
        ]);

        return [
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'user' => $user,
        ];
    }
}
