<?php
// Mulai sesi
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
    $tahun = (int) $_POST['tahun'];
    $tersedia = isset($_POST['tersedia']) ? 1 : 0;

    // Validasi data
    if (empty($judul) || empty($penulis) || empty($tahun)) {
        $_SESSION['error_message'] = "Semua kolom harus diisi!";
        header("Location: add_book.php");
        exit();
    }

    // Query untuk menambahkan buku
    $query = "INSERT INTO books (title, author, publication_year, available) VALUES ('$judul', '$penulis', $tahun, $tersedia)";

    if ($conn->query($query) === TRUE) {
        // Buku berhasil ditambahkan, simpan pesan sukses di sesi
        $_SESSION['success_message'] = "Buku berhasil ditambahkan!";
        // Redirect ke halaman daftar buku
        header("Location: daftarbuku.php");
        exit();
    } else {
        // Jika ada error dalam query
        $_SESSION['error_message'] = "Terjadi kesalahan saat menambahkan buku.";
        header("Location: add_book.php");
        exit();
    }
}

// Tutup koneksi database
$conn->close();
?>
