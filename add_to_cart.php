<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$name = $_POST['name'];
$price = $_POST['price'];

$q = $conn->query("SELECT * FROM cart WHERE product_name='$name'");

if ($q->num_rows > 0) {
    $conn->query("UPDATE cart SET qty = qty + 1 WHERE product_name='$name'");
} else {
    $conn->query("INSERT INTO cart (product_name, price, qty) VALUES ('$name', $price, 1)");
}

echo "success";
?>