<?php

namespace App\GraphQL\Mutations;

use App\Models\UserWatchedMovie;
use Illuminate\Support\Facades\Auth;
use App\Services\MovieService;

class MarkMovieAsWatched
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        $input = $args['input'];

        $movie = $this->movieService->findOrCreate($input);

        return UserWatchedMovie::create([
            'movie_id' => $movie->id,
            'user_id' => $user->id,
        ]);
    }
}

