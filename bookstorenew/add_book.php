<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $genre = $_POST['genre'];
    $imageName = 'default.jpg';

    if (!empty($_FILES['cover_image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['cover_image']['name']); 
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $imageName;
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath);
    }

    $query = "INSERT INTO books (title, author, price, genre,cover_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdss", $title, $author, $price, $genre, $imageName);

    if ($stmt->execute()) {
        header("Location: manage_books.php?success=Book added successfully");
        exit();
    } else {
        $error = "Error adding book!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="styles_books.css">
</head>
<body>
    <div class="books-container">
        <h2>Add a New Book</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <input type="number" step="0.01" name="price" placeholder="Price (₹)" required>
            <select name="genre" required>
                <option value="">Select Genre</option>
                <option value="Fiction">Fiction</option>
                <option value="Self-Help">Self-Help</option>
                <option value="Finance">Finance</option>
                <option value="History">History</option>
                <option value="Philosophy">Philosophy</option>
                <option value="Autobiography">Autobiography</option>
            </select>
            <input type="file" name="cover_image" accept="image/*" required>
            <button type="submit">➕ Add Book</button>
        </form>
        <br>
        <a href="manage_books.php" class="back-btn">⬅ Back to Manage Books</a>
    </div>
</body>
</html>
