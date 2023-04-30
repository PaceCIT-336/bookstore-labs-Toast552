<?php
session_start();
?>
<button onclick="viewSample(<?php echo $book['id']; ?>)">View Sample</button>

<?php
// retrieve the cart items and total price passed from the shop page
if (isset($_POST['cart'], $_POST['total'])) {
    $cart = filter_input(INPUT_POST, 'cart', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    $total_price = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
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
    echo "<div class='row'><div class='cell'>" . htmlspecialchars($book['title'], ENT_QUOTES) . "</div><div class='cell'>$" . number_format($avg_price, 2) . "</div></div>";
}
echo "<div class='row'><div class='cell'>Tax:</div><div class='cell'>$" . number_format($tax, 2) . "</div></div>";
echo "<div class='row summary'><div class='cell'>Total Price:</div><div class='cell'>$" . number_format($total_price + $tax, 2) . "</div></div>";

// thank the user for their purchase
$name = "Your Name"; // replace with user's name (input validation is not done here for simplicity)
if ($total_price > 0) {
    echo "<p>Thank you for your purchase, " . htmlspecialchars($name, ENT_QUOTES) . "!</p>";
} else {
    echo "<p>Oops! It looks like you're here by accident. Click <a href='index.php'>here</a> to get back to the shop page.</p>";
}

// empty the cart and destroy the session
$_SESSION['cart'] = array();
session_destroy();
?>