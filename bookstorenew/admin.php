<?php
session_start();
include 'database.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
    <div class="admin-container">
        <h2>Admin Panel</h2>
        <nav>
            <a href="admin.php">Dashboard</a>
            <a href="manage_books.php">Manage Books</a>
            <a href="manage_orders.php">Manage Orders</a>
            <a href="logout.php">Logout</a>
        </nav>
        <div class="admin-content">
            <h3>Welcome, Admin!</h3>
            <p>Use the navigation to manage the bookstore.</p>
        </div>
    </div>
</body>
</html>
