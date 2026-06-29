<?php

require_once __DIR__ . '/../../config/Database.php';

class MovieRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllMovies()
    {
        $sql = "
        SELECT movies.*, genres.name AS genre
        FROM movies
        LEFT JOIN genres
        ON movies.genre_id = genres.id
        ORDER BY movies.id DESC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGenres()
    {
        $stmt = $this->db->query("
            SELECT *
            FROM genres
            ORDER BY name
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchMovies($search)
    {
        $stmt = $this->db->prepare("
            SELECT movies.*, genres.name AS genre
            FROM movies
            LEFT JOIN genres ON movies.genre_id = genres.id
            WHERE title LIKE ?
            ORDER BY movies.id DESC
        ");

        $stmt->execute(["%$search%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMovie($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM movies
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    public function addMovie($title, $year, $genre_id, $rating)
    {
        $stmt = $this->db->prepare("
            INSERT INTO movies
            (title, year, genre_id, rating)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $title,
            $year,
            $genre_id,
            $rating
        ]);
    }

    public function getMovieById($id)
    {
        $stmt = $this->db->prepare("
            SELECT movies.*, genres.name AS genre
            FROM movies
            LEFT JOIN genres ON movies.genre_id = genres.id
            WHERE movies.id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMovie(
        $id,
        $title,
        $year,
        $genre_id,
        $rating
    )
    {
        $stmt = $this->db->prepare("
            UPDATE movies
            SET
                title=?,
                year=?,
                genre_id=?,
                rating=?
            WHERE id=?
        ");

        return $stmt->execute([
            $title,
            $year,
            $genre_id,
            $rating,
            $id
        ]);
    }
}
