<?php
namespace App\Models;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model.php';

class Genre extends Model
{
   protected int $id;

   protected string $title;


    public function __construct(int $id,string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

}