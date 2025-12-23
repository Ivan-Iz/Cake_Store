<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$username = $_POST['username'];
$email = $_POST['email'];
$no = $_POST['no_telpon'];
$password = $_POST['password'];

// role default pelanggan
$role = "pelanggan";

$query = "
INSERT INTO user (username, email, no_telpon, password, role)
VALUES ('$username', '$email', '$no', '$password', '$role')
";

if ($conn->query($query)) {
    header("Location: login.html");
} else {
    echo "Error: " . $conn->error;
}
?>