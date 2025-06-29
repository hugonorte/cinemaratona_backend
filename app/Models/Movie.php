<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static \Illuminate\Database\Eloquent\Model|\App\Models\Movie find($id)
 */
class Movie extends Model
{
    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the user that Watched Movies.
     */
    public function users_watched(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_watched_movies', 'movie_id', 'user_id')
            ->withTimestamps()
            ->using(UserWatchedMovie::class);
    }
}
