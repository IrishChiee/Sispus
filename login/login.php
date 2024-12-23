<?php
session_start();  // Memulai session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Tambahkan Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(to bottom, rgb(215, 217, 224), #764ba2);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Styling untuk input container */
        .input-container {
            position: relative;
        }

        .input-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1rem;
        }

        input[type="email"], input[type="password"] {
            padding: 10px 10px 10px 35px; /* Padding kiri lebih besar untuk ikon */
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #512da8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3c3cff;
        }

        p {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #c82333;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="../" class="back-button">
    <i class="fas fa-arrow-left"></i>Kembali</a>

    <form action="login_process.php" method="POST">
        <h1>Login</h1>

        <!-- Input Email dengan Ikon -->
        <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <!-- Input Password dengan Ikon -->
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>

        <?php if (isset($_SESSION['error'])): ?>
            <p><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </form>

    <footer>© Copyright 2024</footer>
</body>
</html>
