<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$id = $_POST['id'];
$action = $_POST['action'];

if ($action == "plus") {
    $conn->query("UPDATE cart SET qty = qty + 1 WHERE id=$id");
} else {
    $conn->query("UPDATE cart SET qty = qty - 1 WHERE id=$id AND qty > 1");
}

echo "updated";
?>