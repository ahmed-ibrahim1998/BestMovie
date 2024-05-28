<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Movie;
use App\Models\Watchlist;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class MovieController extends Controller
{
    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }
    public function index()
    {
        $movies = Cache::remember('movies', 60, function () {
            return Movie::paginate(10);
        });
        return response()->json($movies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'year' => 'required',
            'genre' => 'required',
        ]);
        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Cache::remember("movie_{$id}", 60, function () use ($id) {
            return Movie::find($id);
        });
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $tmdbData = $this->tmdbService->getMovie($movie->tmdb_id);
        return response()->json(['movie' => $movie, 'tmdb' => $tmdbData]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'year' => 'required',
            'genre' => 'required',
        ]);

        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        // تسجيل الطلب والبيانات المستلمة
        \Log::info('Update request data:', $request->all());
        $movie->update($request->all());
        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $movie->delete();
        return response()->json(['message' => 'Movie deleted']);
    }

    // • Implement API endpoints to perform tasks like listing, searching, pagination, and filtering by
    //parameters such as movie genre of the stored data (ex: Action, Thriller, Horror...).

    public function filter(Request $request)
    {
        $query = Movie::query();

        // Filter by genre
        if ($request->has('genre')) {
            $query->where('genre', $request->input('genre'));
        }

        // Paginate results
        $movies = $query->paginate(10);

        return response()->json($movies);
    }
    public function search(Request $request)
    {
        $query = Movie::query();

        // Filter by genre
        if ($request->has('title')) {
            $query->where('title', $request->input('title'));
        }

        // Paginate results
        $movies = $query->paginate(10);

        return response()->json($movies);
    }
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        // Get pagination parameters from the request
        $perPage = $request->input('per_page', 15); // Default to 15 items per page if not specified
        $page = $request->input('page', 1);
        // Paginate results
        $movies = Movie::paginate($perPage, ['*'], 'page', $page);

        return response()->json($movies);
    }

    public function addToWatchlist(Request $request, $movieId)
    {
        $watchlist = Watchlist::create([
            'movie_id' => $movieId,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Movie added to watchlist', 'watchlist' => $watchlist]);
    }

    public function markAsFavorite(Request $request, $movieId)
    {
        $favorite = Favorite::create([
            'movie_id' => $movieId,
            'user_id' => $request->user()->id,
        ]);

        // Fetch additional details from IMDB API
        $movie = Movie::find($movieId);
        $imdbId = $movie->imdb_id; // Assume you have an imdb_id column in the movies table

        $tmdbApiKey = env('TMDB_API_KEY');
        $imdbResponse = Http::get("http://www.omdbapi.com/?i=$imdbId&apikey=$tmdbApiKey");
        if ($imdbResponse->successful()) {
            $favorite->imdb_details = $imdbResponse->body();
            $favorite->save();
        }

        return response()->json(['message' => 'Movie marked as favorite', 'favorite' => $favorite]);
    }

    public function fetchImdbDetails($favoriteId)
    {
        $favorite = Favorite::find($favoriteId);

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        $movie = $favorite->movie;
        $imdbId = $movie->imdb_id; // Assume you have an imdb_id column in the movies table

        // Fetch reviews and ratings from IMDB API
        $tmdbApiKey = env('TMDB_API_KEY');

        $imdbResponse = Http::get("http://www.omdbapi.com/?i=$imdbId&apikey=$tmdbApiKey");

        if ($imdbResponse->successful()) {
            $imdbData = $imdbResponse->json();

            $favorite->reviews = $imdbData['Plot'] ?? 'No reviews available';
            $favorite->ratings = $imdbData['imdbRating'] ?? null;
            $favorite->save();

            return response()->json(['message' => 'IMDB details fetched and saved successfully', 'favorite' => $favorite]);
        }

        return response()->json(['message' => 'Failed to fetch IMDB details'], 500);
    }
}
