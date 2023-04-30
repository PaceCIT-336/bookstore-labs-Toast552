<?php
require_once 'login.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve book title from database
    $query_title = "SELECT title FROM books WHERE id = :id";
    $stmt_title = $pdo->prepare($query_title);
    $stmt_title->execute(['id' => $id]);
    $row_title = $stmt_title->fetch(PDO::FETCH_ASSOC);
    $title = htmlspecialchars($row_title['title']);

    // Retrieve reviews from database
    $query_reviews = "SELECT rating, review FROM reviews WHERE book_id = :id";
    $stmt_reviews = $pdo->prepare($query_reviews);
    $stmt_reviews->execute(['id' => $id]);

    echo "<h3>Reviews for $title</h3>";

    while($row = $stmt_reviews->fetch(PDO::FETCH_ASSOC)) {
        $rating = htmlspecialchars($row['rating']);
        $review = htmlspecialchars($row['review']);

        echo "<p>Rating: $rating</p>";
        echo "<p>Review: $review</p>";
        echo "<br>";
    }
} else {
    echo "No book ID provided.";
}
?>
