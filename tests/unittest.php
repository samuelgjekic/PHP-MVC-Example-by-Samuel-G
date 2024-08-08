<?php
use App\Database;

require_once 'vendor/autoload.php';
require_once 'src/Database/Database.php';
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



}