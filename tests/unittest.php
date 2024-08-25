<?php

/* I denna fil använder jag UNIT Testing för att testa mina olika funktioner och metoder. Här kan du följa
min utvecklingsprocess och få en bild av t.ex olika problem jag stötte på. */

use App\Controllers\MovieController;
use App\Database;
use App\Models\Genre;

require_once 'vendor/autoload.php';
require_once 'src/Database/Database.php';
require_once 'src/Controllers/MovieController.php';
require_once 'src/Controllers/ApiController.php';
require_once 'src/Models/Genre.php';



class UnitTest extends \PHPUnit\Framework\TestCase 
{    
    /**
     * testDatabase
     * With this function we can try the database singleton and if it successfully creates
     * a new database and its tables if it does not exist already.
     * @return void
     */
    public function testDatabase()
    {
        $db = Database::getInstance();
        $this->assertNotNull($db);
    }

    public function testCreateMovie()
    {
        $moviecontroller = new MovieController();
        $response = $moviecontroller->createMovie('test','testbeskrivning','2024-05-05',1);
        $this->assertNotNull($response,'Response was null');
        
    }
    
    /**
     * testApi
     * Här testar jag om API anslutningen fungerar genom att
     * hämta alla movie Genres som finns på TMDB. Jag fick dock ta bort
     * SSL verifiering i Guzzles filer för att det ska funka lokalt. Rad 445 till false i
     * CurlFactory.php. Om svaret är JSON format så kommer testet funka. Vi 
     * skriver även ut värdena i arrayen i konsolen med hjälp av echo.
     * 
     * Den hämtar även en komplett "trending movies" lista som array och visar all data i konsolen.
     * @return void
     */
    public function testApi()
    {
        $api = new ApiController();
        $genres = $api->getGenres();

        $this->assertIsArray($genres,'Är inte en array');

        $movies = $api->getTrendingMovies();

        
        foreach($genres as $genre)
        {
            echo ' ID:' . $genre->getId() . ' Titel: ' . $genre->getTitle();
        }

        foreach($movies as $movie)
        {
            echo $movie->getId() . ' Title: ' . $movie->getTitle() . ' Desc:' . $movie->getDesc();
        }
    }
}