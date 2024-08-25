<?php

namespace App;
use Exception;

class Database
{
    private static $instance = null;
    private $mysqli;

    private function __construct()
    {
         // Define database connection details
         $host = 'localhost';
         $username = 'admin';
         $password = 'password';
         $database = 'nti_skolan';
 
         // Connect to the SQL server
         $this->mysqli = new \mysqli($host, $username, $password);
 
         // Check connection
         if ($this->mysqli->connect_error) {
             die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
         }
 
         // Create the database if it doesn't exist
         $this->createDatabase($database);
 
         // Select the DB 
         $this->mysqli->select_db($database);

         $this->createDefaultTables();


     }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone() { }

    public function getConnection()
    {
        return $this->mysqli;
    }

    private function createDatabase($database)
    {
        $query = "CREATE DATABASE IF NOT EXISTS $database";
        if ($this->mysqli->query($query) === true) {
           // Lyckades
        } else {
            echo "Error creating database '$database': " . $this->mysqli->error . "\n";
        }
    }

    public function addTable($tableName, $columns)
    {
        $colDefinitions = [];
        foreach ($columns as $name => $details) {
            $colDefinitions[] = "$name {$details['type']} {$details['options']}";
        }
        $colDefinitions = implode(', ', $colDefinitions);

        $query = "CREATE TABLE IF NOT EXISTS $tableName ($colDefinitions)";
        if ($this->mysqli->query($query) === true) {
            //Lyckades...
                } else {
            echo "Error creating table '$tableName': " . $this->mysqli->error . "\n";
        }
    }
    
    /**
     * createDefaultTables
     * This functions creates the default tables needed for my school project.
     * @return void|bool
     */
    private function createDefaultTables()
{
    // Define columns for the Movie_Genres table
    $genreColumns = [
        'id' => [
            'type' => 'INT',
            'options' => 'AUTO_INCREMENT PRIMARY KEY'
        ],
        'name' => [
            'type' => 'VARCHAR(255)',
            'options' => 'NOT NULL'
        ]
    ];

    // Define columns for the Movies table
    $movieColumns = [
        'id' => [
            'type' => 'INT',
            'options' => 'AUTO_INCREMENT PRIMARY KEY'
        ],
        'title' => [
            'type' => 'VARCHAR(255)',
            'options' => 'NOT NULL'
        ],
        'description' => [
            'type' => 'TEXT',
            'options' => 'NOT NULL'
        ],
        'release_date' => [
            'type' => 'DATE',
            'options' => 'NOT NULL'
        ],
        'genre_id' => [
            'type' => 'INT',
            'options' => 'NOT NULL',
        ],
        'FOREIGN KEY (genre_id)' => [
            'type' => '',
            'options' => 'REFERENCES Movie_Genres(id) ON DELETE CASCADE ON UPDATE CASCADE'
        ]
    ];

    $this->addTable('Movie_Genres', $genreColumns);
    $this->addTable('Movies', $movieColumns);

    // Insert default genres into the Movie_Genres table only if they don't already exist
    $defaultGenres = [
        ['name' => 'Skräck'],
        ['name' => 'Action'],
        ['name' => 'Komedi'],
        ['name' => 'Äventyr'],
        ['name' => 'Ingen Genre Tillgänglig']
    ];

    foreach ($defaultGenres as $genre) {
        $query = "SELECT id FROM Movie_Genres WHERE name = '{$genre['name']}' LIMIT 1";
        $result = $this->mysqli->query($query);

        if ($result->num_rows == 0) {
            // Genre does not exist, insert it
            $insertQuery = "INSERT INTO Movie_Genres (name) VALUES ('{$genre['name']}')";
            if ($this->mysqli->query($insertQuery) === true) {
                echo "Genre '{$genre['name']}' inserted successfully.\n";
            } else {
                echo "Error inserting genre '{$genre['name']}': " . $this->mysqli->error . "\n";
            }
        } else {
            //Finns redan
             }
    }
}

}