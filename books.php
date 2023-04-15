<?php
require_once 'login.php';
require_once 'Books.php'; 

// Assuming $pdo is properly initialized with a PDO object

$query = "SELECT * FROM books";
$result = $pdo->query($query);

$books = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Sanitize each column value using htmlspecialchars
    $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
    $author = htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
    $image_path = htmlspecialchars($row['image_path'], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');

    // Create a Book object with sanitized values
    $book = new Book($id, $title, $author, $description, $image_path, $price);
    $books[$id] = $book;
}

// Debugging: Display $books array
echo '<pre>';
print_r($books);
echo '</pre>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
    <h1>Books</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book->getId(); ?></td>
                <td><?= $book->getTitle(); ?></td>
                <td><?= $book->getAuthor(); ?></td>
                <td><?= $book->getDescription(); ?></td>
                <td><?= $book->getImagePath(); ?></td>
                <td><?= $book->getPrice(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
