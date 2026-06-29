<?php

require_once __DIR__ . '/../src/services/ApiService.php';

header('Content-Type: application/json');

$api = new ApiService();

try {

    if (isset($_GET['id'])) {
        $movie = $api->getMovie((int) $_GET['id']);

        if (!$movie) {
            http_response_code(404);
            echo json_encode([
                "error" => "Movie not found"
            ]);
            exit;
        }

        echo json_encode($movie, JSON_PRETTY_PRINT);
    }

    elseif (isset($_GET['search'])) {
        echo json_encode(
            $api->searchMovies($_GET['search']),
            JSON_PRETTY_PRINT
        );
    }

    else {
        echo json_encode(
            $api->getAllMovies(),
            JSON_PRETTY_PRINT
        );
    }

}
catch (Exception $e) {
    http_response_code(500);

    echo json_encode([
        "error" => $e->getMessage()
    ]);
}
