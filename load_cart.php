<?php
$conn = new mysqli("localhost", "root", "", "store_cake");

$q = $conn->query("SELECT * FROM cart");

$total = 0;

while ($row = $q->fetch_assoc()) {
    $sub = $row['price'] * $row['qty'];
    $total += $sub;

    echo '
    <div class="cart-item">
        <img src="img/Cheesecake.jpg">

        <div class="item-detail">
            <h3>'.$row['product_name'].'</h3>
            <div class="item-price">Rp '.number_format($sub,0,",",".").'</div>

            <div class="qty-control">
                <button onclick="updateQty('.$row['id'].', \'minus\')">-</button>
                <span>'.$row['qty'].'</span>
                <button onclick="updateQty('.$row['id'].', \'plus\')">+</button>

                <button class="delete-btn" onclick="deleteItem('.$row['id'].')">🗑</button>
            </div>
        </div>
    </div>
    ';
}

echo "<hr><h4>Total: Rp ".number_format($total,0,",",".")."</h4>";

echo "<button class='checkout-btn' onclick=\"window.location='checkout.php'\">Beli Sekarang</button>";
?>