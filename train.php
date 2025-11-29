<?php
require_once 'Charmeleon.php';
session_start();

// Pastikan session pokemon sudah ada
if (!isset($_SESSION['pokemon']) || !($_SESSION['pokemon'] instanceof Charmeleon)) {
    $_SESSION['pokemon'] = new Charmeleon();
}

$pokemon = $_SESSION['pokemon'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validasi input
    $type = $_POST['type'] ?? '';
    $intensity = $_POST['intensity'] ?? 0;

    $validTypes = ["Attack", "Defense", "Speed"];

    if (!in_array($type, $validTypes)) {
        $message = "Jenis latihan tidak valid!";
    } elseif (!is_numeric($intensity) || $intensity < 1 || $intensity > 10) {
        $message = "Intensitas harus angka 1-10!";
    } else {

        $intensity = (int)$intensity;

        // Catat kondisi sebelum latihan
        $beforeLevel = $pokemon->getLevel();
        $beforeHp    = $pokemon->getHp();

        // Jalankan latihan
        $result = $pokemon->train($type, $intensity);

        // Sesudah latihan
        $afterLevel = $pokemon->getLevel();
        $afterHp    = $pokemon->getHp();

        // Simpan riwayat
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }

        $_SESSION['history'][] = [
            'type'       => $type,
            'intensity'  => $intensity,
            'beforeLevel'=> $beforeLevel,
            'afterLevel' => $afterLevel,
            'beforeHp'   => $beforeHp,
            'afterHp'    => $afterHp,
            'time'       => date('Y-m-d H:i:s')
        ];

        $message = "Latihan selesai! 
                    Level: $beforeLevel → $afterLevel, 
                    HP: $beforeHp → $afterHp. 
                    Jurus spesial: " . $pokemon->specialMove();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Charmeleon - Latihan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label { display: block; margin-top: 10px; }
        button { margin-top: 10px; padding: 8px 12px; cursor: pointer; }
        .msg { margin-top: 15px; padding: 10px; background: #f1f1f1; border-radius: 6px; }
    </style>
</head>
<body>

    <h1>Latihan Charmeleon</h1>

    <form method="POST">
        <label>Jenis Latihan:</label>
        <select name="type" required>
            <option value="Attack">Attack</option>
            <option value="Defense">Defense</option>
            <option value="Speed">Speed</option>
        </select>

        <label>Intensitas (1-10):</label>
        <input type="number" name="intensity" min="1" max="10" required>

        <button type="submit">Latih</button>
    </form>

    <?php if (!empty($message)) : ?>
        <div class="msg"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <br>
    <a href="index.php"><button>Kembali ke Beranda</button></a>
    <a href="history.php"><button>Riwayat Latihan</button></a>

</body>
</html>
