<?php

namespace App\GraphQL\Mutations;

use App\Models\RefreshToken;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshToken
{
    public function __invoke($root, array $args)
    {
        $refreshToken = RefreshToken::where('token', $args['refresh_token'])
            ->where('expires_at', '>', now())
            ->first();

        if (!$refreshToken) {
            throw new \Exception('Invalid or expired refresh token');
        }

        $user = $refreshToken->user;
        $newToken = JWTAuth::fromUser($user);
        $newRefreshToken = bin2hex(random_bytes(32));

        $refreshToken->update([
            'token' => $newRefreshToken,
            'expires_at' => now()->addDays(7),
        ]);

        return [
            'access_token' => $newToken,
            'refresh_token' => $newRefreshToken,
            'user' => $user,
        ];
    }
}
