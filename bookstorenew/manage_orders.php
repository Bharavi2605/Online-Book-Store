<?php
session_start();
include 'database.php'; // Database connection

// ✅ DEBUGGING: Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// ✅ Fetch all orders
$query = "SELECT id, name, email, address, payment_method, total_price, status FROM orders ORDER BY id DESC";
$result = $conn->query($query);

// ✅ DEBUGGING: Check if orders exist
if (!$result) {
    die("Error fetching orders: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>

<h2>📦 Manage Orders</h2>

<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Payment</th>
        <th>Total Price (₹)</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($order = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['name']) ?></td>
            <td><?= htmlspecialchars($order['email']) ?></td>
            <td><?= htmlspecialchars($order['address']) ?></td>
            <td><?= htmlspecialchars($order['payment_method']) ?></td>
            <td>₹<?= number_format($order['total_price'], 2) ?></td>
            <td>
                <form method="post" action="update_order.php">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="status">
                        <option value="Pending" <?= ($order['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="Shipped" <?= ($order['status'] == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
                        <option value="Delivered" <?= ($order['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <a href="view_order.php?id=<?= $order['id'] ?>">📄 View</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="8">⚠️ No orders found.</td></tr>
    <?php endif; ?>
</table>

<a href="admin.php">🔙 Back to Dashboard</a>

</body>
</html>
