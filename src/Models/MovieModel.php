<?php

namespace App\Models;

class MovieModel extends Model
{
    public function getAllMovies()
    {
        $query = "SELECT * FROM Movies";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMovieById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Movies WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createMovie($title, $description, $releaseDate, $genreId)
    {
        $stmt = $this->db->prepare("INSERT INTO Movies (title, description, release_date, genre_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $title, $description, $releaseDate, $genreId);
        return $stmt->execute();
    }

    // Lägg till fler metoder för att hantera Movies-kollektionen
}