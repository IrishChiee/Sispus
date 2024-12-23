<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data best seller dan total peminjaman
$best_seller_query = "
    SELECT books.title, COUNT(borrowed_books.id) AS total_borrowed
    FROM borrowed_books
    JOIN books ON borrowed_books.book_id = books.id
    GROUP BY books.id
    ORDER BY total_borrowed DESC
    LIMIT 1
";

$rekap_query = "
    SELECT books.title, COUNT(borrowed_books.id) AS total_borrowed
    FROM borrowed_books
    JOIN books ON borrowed_books.book_id = books.id
    GROUP BY books.id
    ORDER BY total_borrowed DESC
";

$best_seller_result = $conn->query($best_seller_query);
$rekap_result = $conn->query($rekap_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan Buku</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            position: relative;
        }

        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .best-seller {
            background-color: #d1f0d1;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-weight: bold;
        }

        .rekap-list ul {
            list-style: none;
            padding: 0;
        }

        .rekap-list li {
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #e6e6fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s, background-color 0.3s;
        }

        .rekap-list li:hover {
            transform: translateY(-3px);
            background-color: #d1d9f0;
        }

        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
            background-color: #dc3545;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #c82333;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        @media (max-width: 768px) {
            .rekap-list li {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-back {
                top: 10px;
                right: 10px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Kembali -->
        <a href="daftarbuku.php" class="btn-back">Kembali</a>

        <!-- Header -->
        <h1>Rekapan Peminjaman Buku</h1>

        <!-- Best Seller -->
        <div class="best-seller">
            <h2>🌟 Best Seller</h2>
            <?php
            if ($best_seller_result->num_rows > 0) {
                $best_seller = $best_seller_result->fetch_assoc();
                echo "<p>" . $best_seller['title'] . " telah dipinjam sebanyak " . $best_seller['total_borrowed'] . " kali.</p>";
            } else {
                echo "<p>Belum ada buku yang dipinjam.</p>";
            }
            ?>
        </div>

        <!-- Rekap Peminjaman -->
        <div class="rekap-list">
            <h2>Daftar Buku yang Dipinjam</h2>
            <ul>
                <?php
                if ($rekap_result->num_rows > 0) {
                    while ($row = $rekap_result->fetch_assoc()) {
                        echo "<li><span>📚 " . $row['title'] . "</span><span>" . $row['total_borrowed'] . " kali</span></li>";
                    }
                } else {
                    echo "<p>Tidak ada data peminjaman.</p>";
                }
                ?>
            </ul>
        </div>
    </div>

    <footer>© Copyright 2024</footer>
</body>
</html>
