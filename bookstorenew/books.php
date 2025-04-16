<?php
session_start();
include 'database.php'; // Include database connection

// Fetch books from the database
$query = "SELECT * FROM books ORDER BY genre";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="styles_books.css"> <!-- Link to CSS -->
</head>
<body>

<h2>Available Books</h2>

<div class="book-container">
    <?php
    $currentGenre = "";
    while ($row = $result->fetch_assoc()):
        if ($currentGenre != $row['genre']) {
            if ($currentGenre != "") {
                echo "</div>"; // Close previous genre section
            }
            $currentGenre = $row['genre'];
            echo "<h3>📚 {$currentGenre}</h3><div class='genre-section'>";
        }
    ?>
        <div class="book-card">
            <img src="uploads/<?= $row['cover_image'] ?>" alt="<?= $row['title'] ?>" class="book-cover">
            <h4><?= $row['title'] ?></h4>
            <p><strong>Author:</strong> <?= $row['author'] ?></p>
            <p><strong>Price:</strong> ₹<?= $row['price'] ?></p>
            <a href="add_to_cart.php?id=<?= $row['id'] ?>" class="btn">🛒 Add to Cart</a>
        </div>
    <?php endwhile; ?>
    </div> <!-- Close last genre section -->
</div>

<a href="cart.php">🛒 View Cart</a>

</body>
</html>
