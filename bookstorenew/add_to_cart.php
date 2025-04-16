<?php
session_start();
include 'database.php'; // Database connection

// Get book ID
if (!isset($_GET['id'])) {
    die("❌ Invalid Book ID");
}

$id = $_GET['id'];

// Fetch book details
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("❌ Book not found.");
}

// Add book to session cart
$_SESSION['cart'][$id] = [
    'title' => $book['title'],
    'price' => $book['price']
];

header("Location: cart.php");
exit();
