<?php

namespace App\Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Models/Movie.php';


use App\Controller;
use App\Models\Movie;
use App\Database;
use FG\ASN1\Universal\Integer;

class MovieController extends Controller
{    
    /**
     * index
     * Denna funktion render index sidan av filmerna
     * @return void
     */
    public function index()
    {
        $movies = $this->fetchAllMoviesWithGenres();
        $this->render('Movies/index', ['movies' => $movies]);
    }
    
    /**
     * create
     * Detta är huvudsidan för att skapa ny film, denna funktion laddar den rätta view
     * @return void
     */
    public function create()
    {
        $this->render('Movies/add');
    }
    
    /**
     * store
     * Detta är funktionen vi kör från rutt för att lägga till ny film i databasen.
     * @return void
     */
    public function store()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $releaseDate = $_POST['release_date'];
        $genreId = $_POST['genre_id'];

        if($genreId == null){
            $genreId = 5;
        }
        $this->createMovie($title, $description, $releaseDate, $genreId);
        header('Location: /');
        exit();
    }
    
    /**
     * fetchAllMoviesWithGenres
     * Denna hämtar alla filmer från databasen men hämtar även deras Genre genom
     * Genre ID eftersom dom är sammankopplade.
     * @return array
     */
    public function fetchAllMoviesWithGenres(): array
    {

        $query = "
            SELECT m.id, m.title, m.description, m.release_date, g.name as genre
            FROM Movies m
            JOIN Movie_Genres g ON m.genre_id = g.id
        ";
        $result = $this->db->query($query);

        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = new Movie(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['release_date'],
                $row['genre']
            );
        }

        return $movies;
    }
    
    /**
     * getAllMovies
     * denna funktion hämtar alla filmer från databasen och lägger till dom i en 
     * array efter att dom skapas som Movie objekt.
     * @return array
     */
    public function getAllMovies()
    {
        $query = "SELECT * FROM Movies";
        $result = $this->db->query($query);
        $movies = [];

        while ($row = $result->fetch_assoc()) {
            $movies[] = new Movie(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['release_date'],
                $row['genre_id']
            );
        }

        return $movies;
    }
    
    /**
     * getMovieById
     * Hämtar film baserat på ID från databasen, används ej i huvudsidan dock.
     * @param  mixed $id
     * @return void|Movie
     */
    public function getMovieById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Movies WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if ($row) {
            return new Movie(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['release_date'],
                $row['genre_id']
            );
        }

        return null;
    }
    
    /**
     * createMovie
     * Denna fnktion skapar en film och lägger in den i databasen.
     * @param  mixed $title
     * @param  mixed $description
     * @param  mixed $releaseDate
     * @param  mixed $genreId
     * @return bool
     */
    public function createMovie($title, $description, $releaseDate, $genreId)
    {
        $stmt = $this->db->prepare("INSERT INTO Movies (title, description, release_date, genre_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $title, $description, $releaseDate, $genreId);
        return $stmt->execute();
    }

    public function delete($id)
{
    $stmt = $this->db->prepare("DELETE FROM Movies WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Skicka tillbaka användaren till huvudsidan
    header('Location: /');
    exit;
}


    
}