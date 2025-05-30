<?php
namespace App\GraphQL\Mutations;

use Tymon\JWTAuth\Facades\JWTAuth;

final class RefreshTokenMutation
{
    public function __invoke($_, array $args)
    {
        $newToken = JWTAuth::refresh($args['refresh_token']);
        $user = JWTAuth::setToken($newToken)->toUser();

        return [
            'access_token' => $newToken,
            'refresh_token' => $args['refresh_token'],
            'user' => $user,
        ];
    }
}
