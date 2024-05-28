<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getMovie($tmdbId)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdbId}?api_key={$this->apiKey}");
        return $response->json();
    }
}
