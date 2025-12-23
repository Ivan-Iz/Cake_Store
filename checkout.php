<?php
$conn = new mysqli("localhost", "root", "", "store_cake");
$q = $conn->query("SELECT * FROM cart");

$total = 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<title>Rincian Belanja</title>
<link rel="stylesheet" href="css/checkout.css">
</head>

<body>

<div class="container">
    <h1>Rincian Belanja</h1>

    <div class="items">
        <?php while($row = $q->fetch_assoc()):
            $sub = $row['price'] * $row['qty'];
            $total += $sub;
        ?>
        <div class="item">
            <strong><?= $row['product_name'] ?></strong>
            <span class="pcs"><?= $row['qty'] ?> pcs</span>
            <span>Rp <?= number_format($sub,0,',','.') ?></span>
        </div>
        <?php endwhile; ?>
    </div>

    <hr>

    <h2>Total: Rp <?= number_format($total,0,',','.') ?></h2>

    <button class="pay-now" onclick="openPaymentForm()">Bayar Sekarang</button>
</div>

<!-- Popup Form Pembayaran -->
<div class="popup" id="paymentForm">
    <div class="popup-content">
        <h2>Metode Pembayaran</h2>

        <form id="paymentSubmit">

            <label>Pilih Bank</label>
            <select required>
                <option value="">-- Pilih Bank --</option>
                <option>BCA</option>
                <option>BRI</option>
                <option>BNI</option>
                <option>BTN</option>
            </select>

            <label>No Rekening</label>
            <input type="text" required>

            <label>Atas Nama</label>
            <input type="text" required>

            <button type="submit" class="btn-bayar">Bayar</button>
        </form>

        <button class="close" onclick="closePaymentForm()">Tutup</button>
    </div>
</div>

<!-- Popup success -->
<div class="popup" id="successPopup">
    <div class="popup-content success">
        <h2>Pembayaran Berhasil</h2>
        <p>Terima kasih sudah berbelanja!</p>

        <button onclick="goHome()">Kembali ke Beranda</button>
        <button onclick="showTransaction()">Transaksi Saya</button>
    </div>
</div>

<script>
let dataBank = "";
let dataRekening = "";
let dataAtasNama = "";
let dataTotal = "<?= $total ?>";

function openPaymentForm() {
    document.getElementById("paymentForm").style.display = "flex";
}
function closePaymentForm() {
    document.getElementById("paymentForm").style.display = "none";
}

document.getElementById("paymentSubmit").onsubmit = function(e) {
    e.preventDefault();

    const form = e.target;
    dataBank = form.querySelector("select").value;
    dataRekening = form.querySelectorAll("input")[0].value;
    dataAtasNama = form.querySelectorAll("input")[1].value;

    let formData = new FormData();
    formData.append("bank", dataBank);
    formData.append("norek", dataRekening);
    formData.append("atas_nama", dataAtasNama);
    formData.append("total", dataTotal);

    fetch("save_transaction.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(invoice => {
        window.invoiceNumber = invoice;
        document.getElementById("paymentForm").style.display = "none";
        document.getElementById("successPopup").style.display = "flex";
    });
};

function showTransaction() {
    window.location.href = "transaksi_saya.php?invoice=" + window.invoiceNumber;
}

function goHome() {
    window.location.href = "dashboard.html";
}
</script>

</body>
</html>