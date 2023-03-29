<?php
require_once 'login.php';
require_once 'Books.php';

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
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $description = htmlspecialchars($row['description']);
    $imagePath = htmlspecialchars($row['image_path']);
    $price = htmlspecialchars($row['price']);
    
    $book = new Book($id, $title, $author, $description, $imagePath, $price);
    
    $books[$id] = $book;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Bookstore</title>
</head>
<body>
	<h1>My Bookstore</h1>
	<?php foreach ($books as $book) { ?>
		<div>
			<h2><?php echo $book->getTitle(); ?></h2>
			<p>Author: <?php echo $book->getAuthor(); ?></p>
			<p>Description: <?php echo $book->getDescription(); ?></p>
			<p>Price: <?php echo $book->getPrice(); ?></p>
			<img src="<?php echo $book->getImagePath(); ?>" alt="<?php echo $book->getTitle(); ?>">
		</div>
	<?php } ?>
</body>
</html>
