<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$id = $_POST['id'];

$conn->query("DELETE FROM cart WHERE id=$id");

echo "deleted";
?>