<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"> <!-- Menyesuaikan path ke style.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome -->
    <title>Register</title>
    <style>
        body {
            background: linear-gradient(to bottom, rgb(215, 217, 224), #764ba2);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .input-container {
            position: relative;
            width: 100%;
        }

        .input-container i {
            position: absolute;
            left: 10px; /* Geser ikon ke kiri */
            top: 50%;
            transform: translateY(-50%);
            color: #aaa; /* Warna ikon */
            font-size: 16px; /* Ukuran ikon */
            z-index: 1; /* Pastikan ikon tidak menimpa input */
        }

        .input-container input,
        .input-container select {
            width: 100%;
            padding: 10px;
            padding-left: 40px; /* Ruang untuk ikon */
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .input-container select {
            appearance: none; /* Hapus default select dropdown arrow */
        }

        .input-container input:focus,
        .input-container select:focus {
            outline: none;
            border-color: #512da8; /* Highlight saat input aktif */
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


        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-button i {
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #c82333;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
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
    <!-- Tombol Kembali -->
    <a href="../index.php" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <form action="" method="POST">
        <h1>Register</h1>

        <!-- Input Name -->
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Name" required>
        </div>

        <!-- Input Email -->
        <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <!-- Input Password -->
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <!-- Select Role -->
        <div class="input-container">
            <i class="fas fa-user-tag"></i>
            <select name="role" required>
                <option value="anggota">Anggota</option>
                <option value="pustakawan">Pustakawan</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit">Register</button>

        <!-- Pesan Sukses/Error -->
        <?php if (isset($_SESSION['success'])): ?>
            <p class="message success"><?= $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <p class="message error"><?= $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </form>

    <footer>© Copyright 2024</footer>
</body>
</html>
