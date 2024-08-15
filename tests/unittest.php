<?php
use App\Controllers\MovieController;
use App\Database;

require_once 'vendor/autoload.php';
require_once 'src/Database/Database.php';
require_once 'src/Controllers/MovieController.php';

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



}