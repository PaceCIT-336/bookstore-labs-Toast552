<?php
// create global session variables to keep track of items added to the cart
if(!isset($_SESSION["items"]) || empty($_SESSION["items"])) {
    $_SESSION["items"] = array();
}
if(!isset($_SESSION["total"]) || empty($_SESSION["total"])) {
    $_SESSION["total"] = 0;
}

//if an add book form has been submitted, retrieve their values from the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['clear'])) {
        clearCart();
    } else {
        $book_title = $_POST['title'];
        $price = floatval($_POST['price']);
        addToCart($book_title, $price);
    }
}

//add a new item to the cart
function addToCart($title, $price) {
    $_SESSION["items"][] = $title; // add book title to the items array
    $_SESSION["total"] += $price;
}

//reset the cart to empty
function clearCart() {
    $_SESSION["items"] = array();
    $_SESSION["total"] = 0;
}
?>