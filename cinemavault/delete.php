<?php

require_once __DIR__ . '/src/services/MovieService.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$service = new MovieService();
$service->deleteMovie($id);

header("Location: index.php");
exit;
