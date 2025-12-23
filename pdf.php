<?php
require("fpdf/fpdf.php");
$conn = new mysqli("localhost", "root", "", "store_cake");

$invoice = $_GET['invoice'];
$q = $conn->query("SELECT * FROM transaksi WHERE invoice='$invoice'");
$d = $q->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Bukti Transaksi',0,1,'C');

$pdf->SetFont('Arial','',12);

$pdf->Cell(0,10,'Invoice: '.$d['invoice'],0,1);
$pdf->Cell(0,10,'Tanggal: '.$d['tanggal'],0,1);
$pdf->Cell(0,10,'Bank: '.$d['bank'],0,1);
$pdf->Cell(0,10,'No Rekening: '.$d['norek'],0,1);
$pdf->Cell(0,10,'Atas Nama: '.$d['atas_nama'],0,1);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Total: Rp '.number_format($d['total'],0,",","."),0,1);

$pdf->SetTextColor(0,150,0);
$pdf->Cell(0,10,'Status: TELAH DIBAYAR',0,1);

$pdf->Output();
?>