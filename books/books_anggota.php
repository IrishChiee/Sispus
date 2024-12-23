<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $book = $stmt->get_result()->fetch_assoc();
} else {
    header("Location: daftarbuku.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="daftarbuku.php" class="btn back">Kembali</a>
    </nav>

    <main>
        <h1>Detail Buku</h1>
        <div class="book-detail">
            <p><strong>Judul:</strong> <?= htmlspecialchars($book['title']) ?></p>
            <p><strong>Penulis:</strong> <?= htmlspecialchars($book['author']) ?></p>
            <p><strong>Tahun Publikasi:</strong> <?= $book['publication_year'] ?></p>
            <p><strong>Ketersediaan:</strong> <?= $book['available'] ? 'Tersedia' : 'Dipinjam' ?></p>
        </div>
    </main>

    <footer>© Copyright 2024</footer>
</body>
</html>
