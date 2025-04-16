<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>

<h2>📊 Admin Dashboard</h2>
<a href="manage_books.php">📚 Manage Books</a> | 
<a href="manage_orders.php">📦 Manage Orders</a> | 
<a href="admin_logout.php">🚪 Logout</a>

</body>
</html>
