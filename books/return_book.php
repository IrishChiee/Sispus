<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil ID peminjaman dari query string
if (isset($_GET['borrow_id'])) {
    $borrow_id = $_GET['borrow_id'];

    // Cek apakah peminjaman ada
    $result = $conn->query("SELECT * FROM borrowed_books WHERE id = $borrow_id AND user_id = $user_id AND return_date IS NULL");
    $borrow = $result->fetch_assoc();

    if ($borrow) {
        // Update tanggal pengembalian
        $return_date = date('Y-m-d');
        $conn->query("UPDATE borrowed_books SET return_date = '$return_date' WHERE id = $borrow_id");

        // Update status buku menjadi tersedia
        $book_id = $borrow['book_id'];
        $conn->query("UPDATE books SET available = 1 WHERE id = $book_id");

        // Redirect ke halaman daftar buku dengan status berhasil
        header("Location: daftar_buku.php?status=returned");
        exit();
    } else {
        // Jika peminjaman tidak ditemukan, redirect dengan status gagal
        header("Location: daftar_buku.php?status=failed");
        exit();
    }
} else {
    // Jika tidak ada ID peminjaman, redirect ke halaman daftar buku
    header("Location: daftar_buku.php");
    exit();
}
?>
