<?php
// Mengatur koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project2';

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
