<?php
session_start();
include 'database.php'; // Database connection

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle item removal
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Handle empty cart
if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles_cart.css"> <!-- Add CSS -->
</head>
<body>

<h2>Your Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Price (₹)</th>
            <th>Action</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $book) {
            echo "<tr>
                <td>{$book['title']}</td>
                <td>₹{$book['price']}</td>
                <td><a href='cart.php?remove={$id}'>❌ Remove</a></td>
            </tr>";
            $total += $book['price'];
        }
        ?>
        <tr>
            <td><strong>Total</strong></td>
            <td><strong>₹<?= $total ?></strong></td>
            <td><a href="cart.php?clear=1">🗑 Clear Cart</a></td>
        </tr>
    </table>

    <br>
    <a href="checkout.php">Proceed to Checkout</a>
<?php endif; ?>

<a href="books.php">Continue Shopping</a>

</body>
</html>
