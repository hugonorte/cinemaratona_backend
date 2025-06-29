<?php

namespace App\GraphQL\Queries;
use App\Models\User;
use Exception;

class WatchedMoviesByUser
{
    public function __invoke($_, array $args)
    {
        $user = User::with('watchedMovies')->find($args['user_id']);

        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }

        $movies = $user->watchedMovies;

        return [
            'total' => $movies->count(),
            'movies' => $movies,
        ];
    }
}
