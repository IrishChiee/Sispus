<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pustakawan') {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php" class="btn back">Kembali</a>
    </nav>

    <main>
        <h1>Manajemen Buku</h1>
        <div class="book-container">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book-card">
                    <p><strong><?= htmlspecialchars($book['title']) ?></strong></p>
                    <p>Oleh: <?= htmlspecialchars($book['author']) ?> (<?= $book['publication_year'] ?>)</p>
                    <p>Status: <?= $book['available'] ? 'Tersedia' : 'Dipinjam' ?></p>
                    <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn btn-edit">Edit</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>© Copyright 2024</footer>
</body>
</html>
