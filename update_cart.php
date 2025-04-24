<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $movie_id = (int) $_POST['id'];
    $quantity = (int) $_POST['quantity'];

    // Update the cart
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$movie_id]);  // Remove item if quantity is 0 or less
    } else {
        $_SESSION['cart'][$movie_id]['quantity'] = $quantity;  // Update quantity
    }

    // Recalculate the total
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $item) {
        $total += $item['quantity'] * $item['price'];
    }

    // Return the total to the frontend
    echo number_format($total, 2);
}
?>