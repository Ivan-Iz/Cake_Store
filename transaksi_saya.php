<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$invoice = $_GET['invoice'];
$q = $conn->query("SELECT * FROM transaksi WHERE invoice='$invoice'");
$d = $q->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Transaksi Saya</title>
<link rel="stylesheet" href="css/transaksi.css">
</head>

<body>

<div class="container">
    <h1>Bukti Transaksi</h1>

    <div class="struk">

        <p><strong>Invoice:</strong> <?= $d['invoice'] ?></p>
        <p><strong>Tanggal:</strong> <?= $d['tanggal'] ?></p>
        <p><strong>Bank:</strong> <?= $d['bank'] ?></p>
        <p><strong>No Rekening:</strong> <?= $d['norek'] ?></p>
        <p><strong>Atas Nama:</strong> <?= $d['atas_nama'] ?></p>

        <hr>

        <p><strong>Total Pembayaran:</strong> Rp <?= number_format($d['total'], 0, ',', '.') ?></p>

        <p><strong>Status:</strong> 
            <span class="status"><?= $d['status'] ?></span>
        </p>

        <button onclick="history.back()">Kembali</button>
        <button onclick="window.location='pdf.php?invoice=<?= $d['invoice'] ?>'">Download PDF</button>

    </div>
</div>

</body>
</html>