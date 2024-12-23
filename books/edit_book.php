<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek apakah pengguna sudah login dan memiliki hak akses pustakawan
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'pustakawan') {
    header("Location: login.php");
    exit();
}

// Ambil ID buku dari URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Ambil data buku yang akan diedit dari database
    $result = $conn->query("SELECT * FROM books WHERE id = $book_id");
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Buku tidak ditemukan!";
        exit();
    }
}

// Proses ketika tombol Simpan Perubahan diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publication_year = $_POST['publication_year'];

        // Validasi input
        if (empty($title) || empty($author) || empty($publication_year) || !is_numeric($publication_year)) {
            $error_message = "Semua field harus diisi dengan benar!";
        } else {
            // Update data buku di database
            $update_query = "UPDATE books SET title = '$title', author = '$author', publication_year = '$publication_year' WHERE id = $book_id";
            if ($conn->query($update_query) === TRUE) {
                header("Location: daftarbuku.php");
                exit();
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan perubahan.";
            }
        }
    }

    // Proses ketika tombol Nonaktifkan diklik
    if (isset($_POST['nonaktif'])) {
        $update_query = "UPDATE books SET available = 0 WHERE id = $book_id";
        if ($conn->query($update_query) === TRUE) {
            header("Location: daftarbuku.php");
            exit();
        } else {
            $error_message = "Terjadi kesalahan saat menonaktifkan buku.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Edit Buku</title>
</head>
<body>
<style>
    /* Reset default margin dan padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom,rgb(215, 217, 224), #764ba2);
        color: #333; /* Warna teks */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
    }

    /* Container utama */
    h1 {
        font-size: 2rem;
        color:rgb(20, 18, 18);
        margin-bottom: 20px;
        text-align: center;
    }

    form {
        background-color: #ffffff;
        padding: 20px 30px; /* Padding sesuai */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        text-align: left;
    }

    /* Label styling */
    label {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    /* Input field styling */
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="text"]:focus {
        border-color: #512da8;
        box-shadow: 0 0 3px rgba(81, 45, 168, 0.3);
    }

    /* Tombol Simpan */
    button[type="submit"] {
        background-color: #32cd32;
        color: #fff;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: #28a745;
        box-shadow: 0 2px 4px rgba(0, 128, 0, 0.2);
    }

    /* Footer */
    footer {
        margin-top: 10px; /* Kurangi margin atas footer */
        font-size: 0.7rem;
        color: #666;
        text-align: center;
    }

    .head-btn {
        position: fixed;
        top: 20px;
        right: 20px;
    }

    .btn {
        padding: 10px 20px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-back {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-back:hover {
        background-color: #c82333;
    }

    button.nonaktif-btn {
        background-color: #dc3545 !important; /* Warna merah */
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button.nonaktif-btn:hover {
        background-color: #c82333 !important; /* Warna merah lebih gelap saat hover */
    }


    /* Tombol Kembali */
    .head-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .btn-back {
        background-color: #dc3545;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-back:hover {
        background-color: #c82333;
    }
    </style>
<div class="head-btn">
    <a href='daftarbuku.php' class="btn btn-back">Kembali</a>
</div>

<h1>Edit Buku</h1>
    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>
    <form action="edit_book.php?id=<?php echo $book_id; ?>" method="POST">
        <label for="title">Judul Buku:</label>
        <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>

        <label for="author">Pengarang:</label>
        <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>

        <label for="publication_year">Tahun Terbit:</label>
        <input type="text" id="publication_year" name="publication_year" value="<?php echo $book['publication_year']; ?>" required>

        <button type="submit" name="save" class="">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <button type="submit" name="nonaktif" class="nonaktif-btn">
            <i class="fas fa-ban"></i> Nonaktifkan
        </button>
    </form>

    <footer>© Copyright 2024</footer>
</body>
</html>
