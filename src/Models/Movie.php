<?php
namespace App\Models;

require_once '../src/Model.php';

class Movie extends Model
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $releaseDate;
    protected int $genre;

    public function __construct(int $id, string $title, string $description, string $releaseDate, int $genreId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
        $this->genre = $genreId;
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
        switch ($this->genre) {
            case 1: return 'Skräck';
            case 2: return 'Action';
            case 3: return 'Komedi';
            case 4: return 'Äventyr';
            default: return 'Ingen Genre Angiven';
        }
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDesc(string $description)
    {
        $this->description = $description;
    }

    public function setReleaseDate(string $releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function setGenreId(int $genreId)
    {
        $this->genre = $genreId;
    }
}
