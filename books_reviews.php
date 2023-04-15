<?php
require_once 'login.php';

// Assuming $pdo is properly initialized with a PDO object

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $bookId = htmlspecialchars($_POST['book_id'], ENT_QUOTES, 'UTF-8');
    $rating = htmlspecialchars($_POST['rating'], ENT_QUOTES, 'UTF-8');
    $review = htmlspecialchars($_POST['review'], ENT_QUOTES, 'UTF-8');

    // Insert review into database
    $query = "INSERT INTO book_reviews (book_id, rating, review) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$bookId, $rating, $review]);

    // Redirect to thank you page or display thank you message
    echo "Thank you for your review!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Review</title>
</head>
<body>
    <h1>Book Review</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" required>
        <br>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>
        <br>
        <label for="review">Review:</label>
        <textarea id="review" name="review" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
