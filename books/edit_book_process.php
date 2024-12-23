<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pustakawan') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $available = $_POST['available'];

    $update_query = "UPDATE books SET title = ?, author = ?, publication_year = ?, available = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssiii", $title, $author, $year, $available, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Buku berhasil diperbarui!'); window.location.href='books_pustakawan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui buku!'); window.history.back();</script>";
    }
} else {
    header("Location: books_pustakawan.php");
}
?>
