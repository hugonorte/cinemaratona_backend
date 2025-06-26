<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;
class MovieService
{
    public function findOrCreate(array $data): Movie
    {
        //$movie = Movie::find($data['movie_id_from_api']);
        //throw new \Exception($data['movie_id_from_api']);
        $movie = Movie::where('movie_id_from_api', $data['movie_id_from_api'])->first();

        //throw new \Exception('testeswwww: '. $movie);

        if (!$movie) {
            $movie = new Movie();
            $movie->movie_id_from_api = $data['movie_id_from_api'];
            $movie->title = $data['title'] ?? '';
            $movie->release_date = $data['release_date'] ?? null;
            $movie->poster = $data['poster'] ?? null;
            $movie->save();
        }

        if(!array_key_exists('title', $data) ||
        !array_key_exists('release_date', $data) ||
        !array_key_exists('poster', $data)) {
            return $movie;
        }

        $movie->title = $data['title'];
        $movie->release_date = $data['release_date'];
        $movie->poster = $data['poster'];
        $movie->save();

        return $movie;
    }
}
