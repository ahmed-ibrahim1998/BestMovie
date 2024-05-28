<?php

namespace App\Models;
// app/Models/Favorite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['movie_id', 'user_id', 'imdb_details', 'reviews', 'ratings'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
