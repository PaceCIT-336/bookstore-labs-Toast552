<?php
require_once 'login.php';

$query = "SELECT * FROM books";
$result = $pdo->query($query);

$books = array();

while ($row = $result->fetch()) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $description = htmlspecialchars($row['description']);
    $image_path = htmlspecialchars($row['image_path']);
    $price = htmlspecialchars($row['price']);

    $book = new Book($id, $title, $author, $description, $image_path, $price);
    $books[$id] = $book;
}
?>
