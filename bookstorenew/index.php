<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="styles_index.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>📚 Online Bookstore</h1>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="books.php">Books</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="signup.php">Signup</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="banner">
            <h2>Find Your Next Favorite Book</h2>
            <p>Explore a vast collection of books across all genres.</p>
            <a href="books.php" class="btn">Browse Books</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Online Bookstore. All Rights Reserved.</p>
    </footer>
</body>
</html>
