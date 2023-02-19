<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rainy Bookstore - Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>
<body>
<header>
    <h1><a href="index.php">Rainy Bookstore</a></h1>
</header>
<main id="checkoutpg">
<?php
session_start();

// retrieve the cart items and total price passed from the shop page
if (isset($_POST['cart']) && isset($_POST['total'])) {
    $cart = unserialize($_POST['cart']);
    $total_price = floatval($_POST['total']);
} else {
    header('Location: index.php');
    exit();
}

// calculate the tax
$tax_rate = 0.04;
$tax = $total_price * $tax_rate;

// calculate the average price and display the cart
$avg_price = $total_price / count($cart);
echo "<h2>Cart</h2><div class='table'><div class='row header'><div class='cell'>Title</div><div class='cell'>Price</div></div>";
foreach ($cart as $book) {
    echo "<div class='row'><div class='cell'>" . htmlspecialchars($book['title']) . "</div><div class='cell'>$" . number_format($avg_price, 2) . "</div></div>";
}
echo "<div class='row'><div class='cell'>Tax:</div><div class='cell'>$" . number_format($tax, 2) . "</div></div>";
echo "<div class='row summary'><div class='cell'>Total Price:</div><div class='cell'>$" . number_format($total_price + $tax, 2) . "</div></div>";

// thank the user for their purchase
$name = "Your Name"; // replace with user's name
if ($total_price > 0) {
    echo "<p>Thank you for your purchase, " . htmlspecialchars($name) . "!</p>";
} else {
    echo "<p>Oops! It looks like you're here by accident. Click <a href='index.php'>here</a> to get back to the shop page.</p>";
}

// empty the cart
unset($_SESSION['cart']);

session_destroy();
?>
</main>
</body>
</html>
