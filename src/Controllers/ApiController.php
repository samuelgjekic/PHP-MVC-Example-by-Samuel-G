<?php

/* Detta är huvudfilen för anslutning och kommunicering med TMDBs Api. */
use App\Controller;
use App\Models\Genre;
use App\Models\Movie;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Models/Genre.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Models/Movie.php';



class ApiController extends Controller
{

    protected $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }


    public function index()
    {
        $movies = $this->getTrendingMovies();
        $this->render('Tmdb/index', ['movies' => $movies]);
    }
    
    /**
     * getGenres
     * Denna funktion hämtar alla movie genres från TMDB Api och returerar
     * dom i en array. Denna funktion är ett exempel på att hämta data från en API.
     * Den skapar Genre modeller och lägger dom i en array.
     * @return []
     */
    public function getGenres() : array
    {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=en', [
          'headers' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkYjczODgzNjA4MTIwZDA2ZGYzMmQ2ZmQzYmRkYmYzYiIsIm5iZiI6MTcyNDA4ODE5NS45MjU0MDQsInN1YiI6IjY2NjFhOWM2Yjc5YmVjMzA5ZDAwYmZhMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.i6NBuYt5BTIDaKvxiRuLexK3a7OSM9ReSlu6c0eDl14',
            'accept' => 'application/json',
          ],
        ]);
        // Vi måste decode JSON datan och skapa en array.
        $data = json_decode($response->getBody(), true);
        $genres = $data['genres'];
        $genre_array = [];

        foreach ($genres as $genre) {
            $genre_model = new Genre(
                $genre['id'],
                $genre['name']
            );
            $genre_array[] = $genre_model;

        }

        // Returera en array med Genre objekt.
        return $genre_array;
    }

    
    /**
     * getTrendingMovies
     * Med hjälp av denna funktion hämtar vi alla "trending" filmer från TMDBs API.
     * @return array
     */
    public function getTrendingMovies()
    {
   $response = $this->client->request('GET', 'https://api.themoviedb.org/3/trending/movie/day?language=en-US', [
    'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkYjczODgzNjA4MTIwZDA2ZGYzMmQ2ZmQzYmRkYmYzYiIsIm5iZiI6MTcyNDA4ODE5NS45MjU0MDQsInN1YiI6IjY2NjFhOWM2Yjc5YmVjMzA5ZDAwYmZhMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.i6NBuYt5BTIDaKvxiRuLexK3a7OSM9ReSlu6c0eDl14',
    'accept' => 'application/json',
   ],
  ]);

  $data = json_decode($response->getBody(), true);
  $movies = $data['results'];
  $movies_array = [];

  foreach($movies as $movie)
  {
    $movie_model = new Movie(
        $movie['id'],
        $movie['title'],
        $movie['overview'],
        $movie['release_date'],
        5
    );
    $movies_array[] = $movie_model;
  }

  return $movies_array;
}
}
