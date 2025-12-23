<?php
session_start();
$conn = new mysqli("localhost", "root", "", "store_cake");

$q = $conn->query("SELECT * FROM transaksi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Riwayat Transaksi</title>
<style>
body { font-family: Arial; padding: 30px; }
table { width: 100%; border-collapse: collapse; }
td, th { border: 1px solid #ddd; padding: 10px; }
</style>
</head>
<body>

<h1>Riwayat Transaksi</h1>

<table>
<tr>
    <th>Invoice</th>
    <th>Total</th>
    <th>Bank</th>
    <th>Tanggal</th>
    <th>Lainnya</th>
</tr>

<?php while($r = $q->fetch_assoc()): ?>
<tr>
    <td><?= $r['invoice'] ?></td>
    <td>Rp <?= number_format($r['total'],0,',','.') ?></td>
    <td><?= $r['bank'] ?></td>
    <td><?= $r['tanggal'] ?></td>
    <td><a href="transaksi_saya.php?invoice=<?= $r['invoice'] ?>">Detail</a></td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>