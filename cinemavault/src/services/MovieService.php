<?php

require_once __DIR__ . '/../Repositories/MovieRepository.php';

class MovieService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new MovieRepository();
    }

    public function getAllMovies()
    {
        return $this->repository->getAllMovies();
    }

    public function getAllGenres()
    {
        return $this->repository->getAllGenres();
    }

    public function searchMovies($search)
    {
        return $this->repository->searchMovies($search);
    }

    public function addMovie(
        $title,
        $year,
        $genre_id,
        $rating
    )
    {
        return $this->repository->addMovie(
            $title,
            $year,
            $genre_id,
            $rating
        );
    }

    public function deleteMovie($id)
    {
        return $this->repository->deleteMovie($id);
    }

    public function getMovieById($id)
    {
        return $this->repository->getMovieById($id);
    }

    public function updateMovie (
        $id,
        $title,
        $year,
        $genre_id,
        $rating
    )
    {
        return $this->repository->updateMovie(
            $id,
            $title,
            $year,
            $genre_id,
            $rating
        );
    }
}
