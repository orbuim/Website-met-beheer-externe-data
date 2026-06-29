<?php

require_once __DIR__ . '/MovieService.php';

class ApiService
{
    private $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService();
    }

    public function getAllMovies()
    {
        return $this->movieService->getAllMovies();
    }

    public function searchMovies($search)
    {
        return $this->movieService->searchMovies($search);
    }

    public function getMovie($id)
    {
        return $this->movieService->getMovieById($id);
    }
}