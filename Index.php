<?php
session_start();
require_once 'Charmeleon.php';

// Inisialisasi objek hanya sekali per sesi
if (!isset($_SESSION['pokemon']) || !($_SESSION['pokemon'] instanceof Charmeleon)) {
    $_SESSION['pokemon'] = new Charmeleon();
}

$pokemon = $_SESSION['pokemon'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charmeleon - Beranda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        button {
            margin: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Informasi Dasar Charmeleon</h1>

    <p><strong>Nama:</strong> <?= htmlspecialchars($pokemon->getName()) ?></p>
    <p><strong>Tipe:</strong> <?= htmlspecialchars($pokemon->getType()) ?></p>
    <p><strong>Level:</strong> <?= number_format($pokemon->getLevel(), 1) ?></p>
    <p><strong>HP:</strong> <?= number_format($pokemon->getHp()) ?></p>
    <p><strong>Jurus Spesial:</strong> <?= htmlspecialchars($pokemon->specialMove()) ?></p>

    <br>

    <a href="train.php"><button>Mulai Latihan</button></a>
    <a href="history.php"><button>Riwayat Latihan</button></a>
</body>
</html>
