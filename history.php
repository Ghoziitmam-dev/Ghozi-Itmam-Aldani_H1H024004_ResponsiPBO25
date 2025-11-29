<?php
session_start();
$history = $_SESSION['history'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Charmeleon - Riwayat Latihan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #fafafa; }
        button { margin-top: 15px; padding: 8px 12px; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Riwayat Latihan Charmeleon</h1>

    <?php if (empty($history)) : ?>
        <p>Belum ada riwayat latihan.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Latihan</th>
                    <th>Intensitas</th>
                    <th>Level (Sebelum → Sesudah)</th>
                    <th>HP (Sebelum → Sesudah)</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $index => $session) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($session['type']) ?></td>
                        <td><?= htmlspecialchars($session['intensity']) ?></td>
                        <td><?= htmlspecialchars($session['beforeLevel']) ?> → <?= htmlspecialchars($session['afterLevel']) ?></td>
                        <td><?= htmlspecialchars($session['beforeHp']) ?> → <?= htmlspecialchars($session['afterHp']) ?></td>
                        <td><?= htmlspecialchars($session['time']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php"><button>Kembali ke Beranda</button></a>

</body>
</html>
