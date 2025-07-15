<?php

namespace App\GraphQL\Queries;

use App\Models\Review;
use Exception;
class TotalEvaluatedMoviesByUser
{
    /**
     * @throws Exception
     */
    public function __invoke($_, array $args): array
    {
        $user = $args['user_id'];

        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }

        $reviews = Review::with('user')->find($args['user_id']);
        return [
            'total' => $reviews->count(),
            'user_id' => $user,
        ];
    }
}
