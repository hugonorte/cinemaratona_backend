<?php

namespace App\GraphQL\Mutations;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Services\MovieService;

class CreateReview
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        //throw new \Exception('wwwwDebug aqui---'.$user);
        $input = $args['input'];
        //throw new \Exception('Input: ' . json_encode($input));

        $movie = $this->movieService->findOrCreate($input);
        //throw new \Exception('Debug aqui---'.$user);

        return Review::create([
            'movie_id' => $movie->id,
            'review'   => $input['review'],
            'rating'   => $input['rating'],
            'user_id'  => $user->id,
        ]);
    }
}

