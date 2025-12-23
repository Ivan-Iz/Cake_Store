<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$bank = $_POST['bank'];
$norek = $_POST['norek'];
$atas = $_POST['atas_nama'];
$total = $_POST['total'];

$invoice = "INV-" . time();

$conn->query("INSERT INTO transaksi (invoice, bank, norek, atas_nama, total, status, tanggal)
VALUES ('$invoice', '$bank', '$norek', '$atas', $total, 'TELAH DIBAYAR', NOW())");

echo $invoice;
?>