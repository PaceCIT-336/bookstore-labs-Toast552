<?php
require_once 'login.php';

// function to sanitize string inputs
function sanitizeString($var) {
    if (get_magic_quotes_gpc()) $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // if the form hasn't been submitted, redirect to review page
    header("Location: review.php");
    exit();
} else {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare insert statement
        $stmt = $pdo->prepare("INSERT INTO reviews (BookID, Rating, Review) VALUES (?, ?, ?)");

        // sanitize input and bind to parameters
        $book_id = $_POST['book_id'];
        $rating = sanitizeString($_POST['rating']);
        $review = sanitizeString($_POST['review']);
        if ($review === '') {
            $review = null;
        }
        $stmt->bindParam(1, $book_id);
        $stmt->bindParam(2, $rating);
        $stmt->bindParam(3, $review);

        // execute statement and check if successful
        $success = $stmt->execute();
        if ($stmt->rowCount() === 1) {
            echo "<p>Your review has been accepted.</p>";
            echo "<a href=\"review.php\"><button>Add Another Review</button></a>";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>