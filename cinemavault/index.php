<?php

require_once __DIR__ . '/src/services/MovieService.php';

$service = new MovieService();

if(isset($_GET['search']) && $_GET['search'] != '')
{
    $movies = $service->searchMovies($_GET['search']);
}
else
{
    $movies = $service->getAllMovies();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CinemaVault</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<nav class="navbar">

    <div class="logo">
        🎬 CinemaVault
    </div>

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="add.php">Add Movie</a>
    </div>

</nav>

<div class="container">

    <div class="header">

        <h1>Movie Database</h1>

        <a href="add.php" class="btn btn-add">
            + Add Movie
        </a>

    </div>

    <form method="GET" class="search-form">

        <input
                type="text"
                name="search"
                placeholder="Search movie..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

        <button type="submit" class="btn btn-edit">
            Search
        </button>

    </form>

    <table>

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>

        <?php foreach($movies as $movie): ?>

            <tr>

                <td><?= $movie['id'] ?></td>

                <td><?= htmlspecialchars($movie['title']) ?></td>

                <td><?= $movie['year'] ?></td>

                <td><?= htmlspecialchars($movie['genre'] ?? 'Unknown') ?></td>

                <td><?= $movie['rating'] ?></td>

                <td>

                    <a
                            href="edit.php?id=<?= $movie['id'] ?>"
                            class="btn btn-edit">
                        Edit
                    </a>

                    <a
                            href="delete.php?id=<?= $movie['id'] ?>"
                            class="btn btn-delete"
                            onclick="return confirm('Delete this movie?')">
                        Delete
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>
