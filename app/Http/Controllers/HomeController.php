<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        // $movies = Movie::all()->sortByDesc(function($movie) {
        //     return $movie->ratings->avg('rating');
        // })->take(100);

        
        // by using cache avaoiding the time to fetching the same data again and again from the database
        $movies = Cache::remember('top_movies', now()->addHours(2), function () {
            return DB::table('movies as m')
                ->select(
                    'm.id',
                    'm.title',
                    'm.release_year',
                    'c.name as category',
                    DB::raw('AVG(ratings.rating) as average_rating'),
                    DB::raw('COUNT(ratings.id) as rating_count')
                )
                ->leftJoin('ratings as r', 'm.id', '=', 'r.movie_id')
                ->join('categories as c', 'm.category_id', '=', 'c.id')
                ->groupBy('m.id', 'm.title', 'm.release_year', 'c.name')
                ->orderByDesc('average_rating')
                ->limit(100)
                ->get();
        });
        
        // dd($movies);
        return view('home', compact('movies'));

    }
}
