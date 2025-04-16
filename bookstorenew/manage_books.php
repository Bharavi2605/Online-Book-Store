<?php
session_start();
include 'database.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch all books from the database
$query = "SELECT * FROM books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="styles_books.css">
</head>
<body>
    <div class="books-container">
        <h2>Manage Books</h2>
        <a href="add_book.php" class="add-button">➕ Add New Book</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><img src="uploads/<?= $row['cover_image'] ?>" alt="Book Cover" width="50"></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['author'] ?></td>
                    <td><?= $row['genre'] ?></td>
                    <td>₹<?= $row['price'] ?></td>

                    <td>
                        <a href="edit_book.php?id=<?= $row['id'] ?>">✏ Edit</a>
                        <a href="delete_book.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure?');">🗑 Delete</a>
                    </td>

                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="admin.php" class="back-btn">⬅ Back to Admin Panel</a>
    </div>
</body>
</html>
