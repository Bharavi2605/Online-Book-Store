<?php
$host = "localhost";  // Change this if needed
$user = "root";       // Your MySQL username
$pass = "";           // Your MySQL password (if any)
$dbname = "bookstoredb"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
