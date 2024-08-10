<?php
namespace App\Models;
use App\Database;

class Model 
{
    protected $db;
    public function __construct()
    {
    $this->db = Database::getInstance()->getConnection();
    }
}