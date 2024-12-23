<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(to bottom,rgb(215, 217, 224), #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            color: #fff;
        }

        h1 {
            color:rgb(20, 18, 18);
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #333;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        input[type="text"], input[type="number"], button {
            font-size: 1rem;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.5);
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background: #218838;
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #e53e3e;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-button:hover {
            background: #c53030;
        }
    </style>
</head>
<body>
    <a href="daftarbuku.php" class="back-button">Kembali</a>
    <h1>Tambah Buku Baru</h1>
    <form action="proses_tambah_buku.php" method="POST">
        <label for="judul">Judul Buku:</label>
        <input type="text" id="judul" name="judul" required>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" required>

        <label for="tahun">Tahun Terbit:</label>
        <input type="number" id="tahun" name="tahun" required>

        <label>
            <input type="checkbox" name="tersedia" value="1" checked> Tersedia
        </label>

        <button type="submit">Tambah Buku</button>
    </form>
</body>
</html>
