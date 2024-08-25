<?php
namespace App\Models;
use App\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Database/Database.php';


class Movie extends Model
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $releaseDate;
    protected string $genre;

    public function __construct(int $id, string $title, string $description, string $releaseDate, string $genre)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
        $this->genre = $genre;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDesc(): string
    {
        return $this->description;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }
}

