<?php

namespace App\GraphQL\Queries;

use App\Models\UserWatchedMovie;
use App\Services\MovieService;

class CheckUserWatchedMovie
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    /**
     * Retorna true se o usuário assistiu o filme, senão null.
     */
    public function __invoke($_, array $args)
    {
        $data = [
            'movie_id_from_api' => $args['movie_id'],
            'user_id' => $args['user_id'],
        ];

        $movie = $this->movieService->findOrCreate($data);

        $exists = UserWatchedMovie::where('user_id', $args['user_id'])
            ->where('movie_id', $movie->id)
            ->exists();

        return $exists ? true : null;
    }
}

