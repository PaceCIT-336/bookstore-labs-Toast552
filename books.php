<?php
require_once 'login.php';

try {
  $query = "SELECT * FROM books";
  $result = $pdo->query($query);

  $books = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
      $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
      $author = htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8');
      $description = htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
      $image_path = htmlspecialchars($row['image_path'], ENT_QUOTES, 'UTF-8');
      $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');

      $book = new Book($id, $title, $author, $description, $image_path, $price);
      $books[$id] = $book;
  }
} catch(PDOException $e) {
  // Handle database error
  echo "Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>
