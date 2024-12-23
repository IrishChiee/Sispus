<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'anggota') {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT bb.id, b.title, b.author, bb.borrow_date
          FROM borrowed_books bb
          JOIN books b ON bb.book_id = b.id
          WHERE bb.user_id = ? AND bb.return_date IS NULL";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Dipinjam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php" class="btn back">Kembali</a>
    </nav>

    <main>
        <h1>Buku yang Sedang Dipinjam</h1>
        <ul>
            <?php while ($book = $result->fetch_assoc()): ?>
                <li>
                    <p><strong><?= htmlspecialchars($book['title']) ?></strong> oleh <?= htmlspecialchars($book['author']) ?></p>
                    <p>Tanggal Pinjam: <?= $book['borrow_date'] ?></p>
                    <a href="return_book.php?id=<?= $book['id'] ?>" class="btn btn-return">Kembalikan</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>

    <footer>© Copyright 2024</footer>
</body>
</html>
