<?php
require_once 'login.php';

$host = gethostname();
$dbname = 'my_database';
$username = 'my_username';
$password = 'my_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$query = "SELECT * FROM books";
$result = $pdo->query($query);

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $price = htmlspecialchars($row['price']);
    
    echo "<div>";
    echo "<h2>$title</h2>";
    echo "<p>Author: $author</p>";
    echo "<p>Price: $price</p>";
    echo "</div>";
}
?>
