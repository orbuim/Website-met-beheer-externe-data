<?php

require_once __DIR__ . '/src/services/MovieService.php';

$service = new MovieService();
$genres = $service->getAllGenres();
$error = '';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$movie = $service->getMovieById($id);

if (!$movie) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $year = (int) ($_POST['year'] ?? 0);
    $genreId = (int) ($_POST['genre_id'] ?? 0);
    $rating = (float) ($_POST['rating'] ?? 0);

    if ($title === '' || $year <= 0 || $genreId <= 0) {
        $error = 'Please fill in all required fields.';
    } else {
        $service->updateMovie($id, $title, $year, $genreId, $rating);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">CinemaVault</div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="add.php">Add Movie</a>
    </div>
</nav>

<div class="container">

    <h1>Edit Movie</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label for="title">Title</label>
        <input
            id="title"
            type="text"
            name="title"
            value="<?= htmlspecialchars($_POST['title'] ?? $movie['title']) ?>"
            required>

        <label for="year">Year</label>
        <input
            id="year"
            type="number"
            name="year"
            min="1888"
            max="2100"
            value="<?= htmlspecialchars($_POST['year'] ?? $movie['year']) ?>"
            required>

        <label for="genre_id">Genre</label>
        <select id="genre_id" name="genre_id" required>
            <option value="">Select genre</option>
            <?php foreach ($genres as $genre): ?>
                <?php $selectedGenre = $_POST['genre_id'] ?? $movie['genre_id']; ?>
                <option
                    value="<?= $genre['id'] ?>"
                    <?= (string) $selectedGenre === (string) $genre['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genre['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="rating">Rating</label>
        <input
            id="rating"
            type="number"
            name="rating"
            min="0"
            max="10"
            step="0.1"
            value="<?= htmlspecialchars($_POST['rating'] ?? $movie['rating']) ?>">

        <button class="btn btn-edit" type="submit">
            Save Changes
        </button>

        <a href="index.php" class="btn btn-secondary">Cancel</a>

    </form>

</div>

</body>
</html>
