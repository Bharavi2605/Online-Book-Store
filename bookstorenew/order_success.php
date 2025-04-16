<?php
session_start();

// ✅ Check if order was placed successfully
if (!isset($_SESSION['order_id']) || !isset($_SESSION['total_amount'])) {
    header("Location: index.php"); // Redirect to homepage if accessed directly
    exit();
}

// ✅ Securely get order details
$order_id = htmlspecialchars($_SESSION['order_id']);
$total_amount = htmlspecialchars(number_format($_SESSION['total_amount'], 2));

// ✅ Clear order session data
unset($_SESSION['order_id']);
unset($_SESSION['total_amount']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="styles_success.css"> <!-- Link to CSS -->
</head>
<body>

<div class="container">
    <div class="success-message">
        <h2>🎉 Order Placed Successfully!</h2>
        <p>Your order <strong>#<?php echo $order_id; ?></strong> has been placed.</p>
        <p>Total Amount: <strong>₹<?php echo $total_amount; ?></strong></p>
        <p>Thank you for shopping with us! You will receive an email confirmation soon. 📩</p>
        <a href="books.php" class="btn"><b>📚 Continue Shopping<b></a>
    </div>
</div>

</body>
</html>
