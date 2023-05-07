<?php
session_start(); // always start a session before using session variables

// create global session variables to keep track of items added to the cart
if(!isset($_SESSION["items"]) || !is_array($_SESSION["items"])) {
    $_SESSION["items"] = array();
}
if(!isset($_SESSION["total"]) || !is_numeric($_SESSION["total"])) {
    $_SESSION["total"] = 0;
}

//if an add book form has been submitted, retrieve their values from the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['clear'])) {
        clearCart();
    } else {
        if(isset($_POST['title']) && isset($_POST['price'])) {
            $book_title = $_POST['title'];
            $price = floatval($_POST['price']);
            addToCart($book_title, $price);
        } else {
            echo "Error: Missing title or price parameters";
        }
    }
}

//add a new item to the cart
function addToCart($title, $price) {
    if(!is_string($title) || $title === '') {
        echo "Error: Invalid title parameter";
        return;
    }
    if(!is_numeric($price) || $price <= 0) {
        echo "Error: Invalid price parameter";
        return;
    }
    $_SESSION["items"][] = $title; // add book title to the items array
    $_SESSION["total"] += $price;
}

//reset the cart to empty
function clearCart() {
    $_SESSION["items"] = array();
    $_SESSION["total"] = 0;
}
?>
