<?php
session_start();
include 'database.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid order ID!'); window.location.href='manage_orders.php';</script>";
    exit;
}

$orderId = $_GET['id'];

// Fetch order details
$orderQuery = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

if (!$order) {
    echo "<script>alert('Order not found!'); window.location.href='manage_orders.php';</script>";
    exit;
}

// Fetch ordered items
$itemsQuery = "SELECT books.title, order_items.quantity, order_items.price 
               FROM order_items 
               JOIN books ON order_items.book_id = books.id 
               WHERE order_items.order_id = ?";
$stmt = $conn->prepare($itemsQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$itemsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>

<h2>📄 Order Details (ID: <?= $orderId ?>)</h2>

<p><strong>Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
<p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
<p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
<p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>

<h3>📚 Ordered Books</h3>
<table border="1">
    <tr>
        <th>Book Title</th>
        <th>Quantity</th>
        <th>Price (₹)</th>
    </tr>
    <?php while ($item = $itemsResult->fetch_assoc()) : ?>
    <tr>
        <td><?= htmlspecialchars($item['title']) ?></td>
        <td><?= $item['quantity'] ?></td>
        <td>₹<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="manage_orders.php">🔙 Back to Orders</a>

</body>
</html>
