<?php
require_once 'login.php';
require_once 'Book.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$query = "SELECT * FROM books";
$result = $pdo->query($query);

$books = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $description = htmlspecialchars($row['description']);
    $image_path = htmlspecialchars($row['image_path']);
    $price = htmlspecialchars($row['price']);
    
    $book = new Book($id, $title, $author, $description, $image_path, $price);
    $books[$id] = $book;
    
    echo "<section>";
    echo "<h2>$title</h2>";
    echo "<img src=\"$image_path\">";
    echo "<form method=\"post\" action=\"cart.php\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\">";
    echo "<button type=\"submit\">Add to Cart</button>";
    echo "</form>";
    echo "<br><a href=\"book_reviews.php?id=$id\"><button>See Reviews</button></a>";
    echo "</section>";
}
?>