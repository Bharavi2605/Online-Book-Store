<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php'; // Database connection

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('❌ Your cart is empty!'); window.location.href='books.php';</script>";
    exit;
}

$cartItems = [];
$totalPrice = 0.0;

// Fetch books from database based on cart
foreach ($_SESSION['cart'] as $bookId => $quantity) {
    $query = "SELECT id, title, price FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {
        $book['quantity'] = intval($quantity); // ✅ Ensure quantity is an integer
        $book['price'] = floatval($book['price']); // ✅ Ensure price is a float

        $cartItems[] = $book;
        $totalPrice += $book['price'] * $book['quantity']; // ✅ Fixes error here
    }
}

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $payment_method = $_POST['payment_method'];

    if (empty($name) || empty($email) || empty($address)) {
        echo "<script>alert('❌ Please fill all details correctly!');</script>";
    } else {
        // Insert order into `orders` table
        $orderQuery = "INSERT INTO orders (name, email, address, payment_method, total_price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($orderQuery);
        $stmt->bind_param("ssssd", $name, $email, $address, $payment_method, $totalPrice);

        if ($stmt->execute()) {
            $orderId = $stmt->insert_id;

            // Insert each book into `order_items` table
            foreach ($cartItems as $book) {
                $bookQuery = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($bookQuery);
                $stmt->bind_param("iiid", $orderId, $book['id'], $book['quantity'], $book['price']);
                $stmt->execute();
            }

            // Store order ID in session for order success page
            $_SESSION['order_id'] = $orderId;
            $_SESSION['total_amount'] = $totalPrice;

            // Clear the cart after a successful order
            unset($_SESSION['cart']);

            // ✅ Redirect to order_success.php
            header("Location: order_success.php");
            exit;
        } else {
            echo "<script>alert('❌ Error placing order.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles_checkout.css">
</head>
<body>

<h2>🛒 Checkout</h2>

<div class="cart-summary">
    <h3>Order Summary</h3>
    <ul>
        <?php foreach ($cartItems as $book): ?>
            <li><?= htmlspecialchars($book['title']) ?> (x<?= $book['quantity'] ?>) - ₹<?= number_format($book['price'] * $book['quantity'], 2) ?></li>
        <?php endforeach; ?>
    </ul>
    <p><strong>Total Price:</strong> ₹<?= number_format($totalPrice, 2) ?></p>
</div>

<form method="post">
    <h3>Shipping Details</h3>
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>Payment Method:</label>
    <select name="payment_method">
        <option value="Cash on Delivery">Cash on Delivery</option>
        <option value="UPI">UPI</option>
        <option value="Credit/Debit Card">Credit/Debit Card</option>
    </select>

    <button type="submit">Place Order</button>
</form>

<a href="cart.php">🔙 Back to Cart</a>

</body>
</html>
