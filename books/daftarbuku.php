<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
$user_name = $_SESSION['user_name']; 

// Tanggal saat ini
$current_date = date('d F Y');  
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Menambahkan Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Daftar Buku</title>
    <style>
        /* CSS sebelumnya tetap */
        body {
            background: linear-gradient(to bottom,rgb(215, 217, 224), #764ba2);    
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Ubah dari 'center' ke 'flex-start' */
            min-height: 100vh;
            padding-top: 60px; /* Jarak atas agar konten terlihat */
            font-family: 'Poppins', sans-serif; 
        }

        h1, h2 {
            color:rgb(20, 18, 18);
            text-align: center;
            margin: 10px 0; /* Tambahkan sedikit jarak antar elemen */
        }

        .header-buttons {
            position: fixed; /* Perbaiki posisi agar selalu di atas */
            top: 20px; /* Jarak dari atas */
            right: 20px; /* Jarak dari kanan */
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-safe {
            background-color: #32cd32;
        }

        .btn-safe:hover {
            background-color: #00ff00;
        }

        .btn-recap {
            background-color: #512da8;
        }

        .btn-recap:hover {
            background-color: #4b0082;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .book-list {
            max-width: 900px;
            width: 100%;
            max-height: 400px; /* Batasi tinggi maksimum daftar buku */
            overflow-y: auto; /* Scroll jika konten terlalu panjang */
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;    
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Jarak dari elemen di atasnya */
        }


        .book-list ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .book-list li {
            margin: 15px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Style khusus untuk buku yang dinonaktifkan */
        .book-list .inactive-book {
            background-color: #ffe6e6;
            color: #b30000;
            text-decoration: line-through;
        }

        .book-list .inactive-book:hover {
            background-color: #ffcccc;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #fff;
            text-align: center;
        }

        /* Menambahkan ikon di samping teks */
        .book-list li i {
            margin-right: 10px;
            font-size: 20px;
            color: #667eea; /* Warna ikon buku */
        }

        .btn i {
            margin-right: 8px; /* Memberikan jarak antara ikon dan teks */
        }

    </style>
</head>
<body>
<div class='header-buttons'>
    <?php if ($user_role == 'pustakawan') : ?>
        <a href='add_book.php' class='btn btn-safe'>
            <i class="fas fa-plus-circle"></i> Tambah Buku
        </a>
    <?php endif; ?>
    <a href='rekap.php' class='btn btn-recap'>
        <i class="fas fa-book-reader"></i> Rekapan Buku
    </a>
    <a href='../logout.php' class='btn btn-danger'>
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>


    </div>
    <h2>Hallo, <?php echo $user_name; ?>! Hari ini tanggal <?php echo $current_date; ?></h2>

    <h1>Daftar Buku</h1>
    <div class='book-list'>
        <ul>
            <?php
            // Query untuk mengambil daftar buku
            $result = $conn->query("SELECT * FROM books");
            while ($row = $result->fetch_assoc()) {
                // Cek status buku
                $class = $row['available'] == 0 ? 'inactive-book' : '';
                echo "<li class='$class'><i class='fas fa-book'></i>" . $row['title'] . " oleh " . $row['author'] . " (" . $row['publication_year'] . ")";
            
                // Jika anggota, tampilkan opsi pinjam atau kembalikan
                if ($user_role == 'anggota') {
                    $borrowed_result = $conn->query("SELECT id FROM borrowed_books WHERE user_id = $user_id AND book_id = " . $row['id'] . " AND return_date IS NULL");
                    if ($borrowed_result->num_rows > 0) {
                        // Buku sedang dipinjam, tampilkan tombol "Kembalikan"
                        $borrowed_row = $borrowed_result->fetch_assoc();
                        echo "<span><a href='return_book.php?borrow_id=" . $borrowed_row['id'] . "'>Kembalikan</a></span>";
                    } elseif ($row['available'] == 1) {
                        // Buku tersedia, tampilkan tombol "Pinjam"
                        echo "<span><a href='borrow_book.php?book_id=" . $row['id'] . "'>Pinjam</a></span>";
                    }
                }
                 // Jika pustakawan, tampilkan opsi edit
                 if ($user_role == 'pustakawan') {
                    echo "<span><a href='edit_book.php?id=" . $row['id'] . "'>Edit</a></span>";
                }
                echo "</li>";
            }
            ?>
        </ul>
    </div>

    <footer>© Copyright 2024</footer>
</body>
</html>
