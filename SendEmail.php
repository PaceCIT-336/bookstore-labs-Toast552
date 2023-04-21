SendEmail.php
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
$message = "<h2>Order Details</h2><div class='table'><div class='row header'><div class='cell'>Title</div><div class='cell'>Price</div></div>";
foreach ($cart as $book) {
    $message .= "<div class='row'><div class='cell'>" . htmlspecialchars($book['title']) . "</div><div class='cell'>$" . number_format($avg_price, 2) . "</div></div>";
}
$message .= "<div class='row'><div class='cell'>Tax:</div><div class='cell'>$" . number_format($tax, 2) . "</div></div>";
$message .= "<div class='row summary'><div class='cell'>Total Price:</div><div class='cell'>$" . number_format($total_price + $tax, 2) . "</div></div>";

// thank the user for their purchase
$name = "Your Name"; // replace with user's name
$message = ($total_price > 0) ? "<p>Thank you for your purchase, " . htmlspecialchars($name) . "!</p>" : "<p>Oops! It looks like you're here by accident. Click <a href='index.php'>here</a> to get back to the shop page.</p>";

// empty the cart
unset($_SESSION['cart']);

session_destroy();

// send email
$to = "ggeltman@ggdatagroup"; // replace with store owner's email address
$subject = "New Order";
$headers = "From: Your Name <ggeltman@ggdatagroup\r\n";
$headers .= "Reply-To: ggeltman@ggdatagroup\r\n";
$headers .= "Content-Type: text/html\r\n";
mail($to, $subject, $message, $headers);
?>