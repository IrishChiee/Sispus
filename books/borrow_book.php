<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil ID buku dari query string
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Cek apakah buku tersedia
    $result = $conn->query("SELECT * FROM books WHERE id = $book_id");
    $book = $result->fetch_assoc();

    if ($book && $book['available'] == 1) {
        // Masukkan data peminjaman ke tabel borrowed_books
        $borrow_date = date('Y-m-d');
        $conn->query("INSERT INTO borrowed_books (user_id, book_id, borrow_date) VALUES ($user_id, $book_id, '$borrow_date')");

        // Update status buku menjadi tidak tersedia
        $conn->query("UPDATE books SET available = 0 WHERE id = $book_id");

        // Redirect ke halaman daftar buku
        header("Location: daftar_buku.php?status=success");
        exit();
    } else {
        // Jika buku tidak tersedia, redirect dengan status gagal
        header("Location: daftar_buku.php?status=failed");
        exit();
    }
} else {
    // Jika tidak ada ID buku, redirect ke halaman daftar buku
    header("Location: daftar_buku.php");
    exit();
}
?>
