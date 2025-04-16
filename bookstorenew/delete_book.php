<?php
include 'database.php'; // Ensure database connection

// Check if ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Book ID");
}

$book_id = $_GET['id'];

// Delete the book from the database
$delete_query = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("i", $book_id);

if ($stmt->execute()) {
    header("Location: manage_books.php?success=Book deleted successfully");
    exit();
} else {
    echo "❌ Error deleting book: " . $stmt->error;
}
?>
