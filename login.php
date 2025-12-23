<?php
session_start();

// KONEKSI DATABASE
$conn = new mysqli("localhost", "root", "", "store_cake");

// Jika form login ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user
    $q = $conn->query("SELECT * FROM user WHERE username='$username' AND password='$password'");

    if ($q->num_rows == 1) {
        $u = $q->fetch_assoc();

        // Simpan session
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['role'] = $u['role'];

        // CEK ROLE
        if ($u['role'] == 'owner' || $u['role'] == 'kasir') {

            // Owner & Kasir diarahkan ke riwayat transaksi
            header("Location: riwayat_transaksi.php");
            exit;

        } else {

            // Pelanggan diarahkan ke halaman utama
            header("Location: dashboard.html");
            exit;
        }

    } else {
        $_SESSION['error'] = "Username atau password salah!";
        header("Location: login.html");
        exit;
    }
}
?>