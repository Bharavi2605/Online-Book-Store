<?php
session_start();
include 'database.php';

// Check if ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Book ID");
}

$book_id = $_GET['id'];

// Fetch current book details
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("Book not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $genre = $_POST['genre'];

    // Default to existing image
    $cover_image = $book['cover_image'];

    // If new image is uploaded
    if (!empty($_FILES['cover_image']['name'])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["cover_image"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;

        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
            $cover_image = $target_file;
        } else {
            echo "<script>alert('❌ Image upload failed. Please try again.');</script>";
        }
    }

    // Update the book in DB
    $update_query = "UPDATE books SET title=?, author=?, price=?, genre=?, cover_image=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssdsdi", $title, $author, $price, $genre, $cover_image, $book_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Book updated successfully.'); window.location.href='manage_books.php';</script>";
        exit();
    } else {
        echo "Error updating book: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styles_books.css">
</head>
<body>

<h2>Edit Book</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br>

    <label>Price (₹):</label>
    <input type="number" step="0.01" name="price" value="<?= $book['price'] ?>" required><br>

    <label>Genre:</label>
    <input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required><br>

    <label>Cover Image:</label>
    <input type="file" name="cover_image"><br>
    <?php if (!empty($book['cover_image'])): ?>
        <img src="<?= $book['cover_image'] ?>" alt="Cover Image" width="120"><br>
    <?php endif; ?>

    <button type="submit">Update Book</button>
</form>

<a href="manage_books.php" class="back-btn">⬅ Back to Manage Books</a>

</body>
</html>
