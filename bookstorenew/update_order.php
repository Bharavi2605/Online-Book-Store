<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $orderId);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Order status updated!'); window.location.href='manage_orders.php';</script>";
    } else {
        echo "<script>alert('❌ Error updating order status.');</script>";
    }
}
?>
