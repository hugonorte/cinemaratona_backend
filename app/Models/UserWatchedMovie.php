<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWatchedMovie extends Pivot
{
    protected $table = 'user_watched_movies';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    public function movie() : BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
