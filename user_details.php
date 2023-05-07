<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rainy Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
    <!-- Import React and Babel -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <!-- Import React component and render to the user div -->
    <script type="text/babel" src="assets/react/script.js"></script>
</head>
<body>
    <div id="user"></div>
    <?php
    session_start();
    require_once 'login.php'; 
    // Find if a customer is logged in
    $id = NULL;
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else {
        // If not logged in, redirect to login page
        header("Location: authenticate.php");
        exit;
    }
    // connect to database
    $conn = mysqli_connect("localhost", "username", "password", "database");
    // get user details
    $user_id = $_GET['id'];
    // use prepared statement to avoid SQL injection
    $user_query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user = mysqli_fetch_assoc($user_result);
    // get user's purchases
// use prepared statement to avoid SQL injection
$purchases_query = "SELECT BookID, OrderDate FROM purchases WHERE CustomerID = ?";
$stmt = $conn->prepare($purchases_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$purchases_result = $stmt->get_result();
$purchases = array();
while ($purchase = mysqli_fetch_assoc($purchases_result)) {
  // get book title for each purchased book
  $book_id = $purchase['BookID'];
  // use prepared statement to avoid SQL injection
  $book_query = "SELECT Title FROM books WHERE BookID = ?";
  $stmt = $conn->prepare($book_query);
  $stmt->bind_param("i", $book_id);
  $stmt->execute();
  $book_result = $stmt->get_result();
  $book = mysqli_fetch_assoc($book_result);
  $purchase['Title'] = $book['Title'];
  // add purchase to purchases array
  $purchases[] = $purchase;
}

// display user details and purchase history
echo "<h1>User Details</h1>";
echo "<p>Name: " . htmlspecialchars($user['Name']) . "<"; 
