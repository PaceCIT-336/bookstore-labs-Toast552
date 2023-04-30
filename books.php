<?php
require_once 'login.php';
require_once 'books.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
    <h1>Books</h1>
    <?php
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
            $book = new $books($id, $title, $author, $description, $image_path, $price);
            $books[$id] = $books;
        }
    
        // Debugging: Display $books array
        // echo '<pre>';
        // print_r($books);
        // echo '</pre>';
    
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Title</th>';
        echo '<th>Author</th>';
        echo '<th>Description</th>';
        echo '<th>Image</th>';
        echo '<th>Price</th>';
        echo '</tr>';
    
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book->getId() . '</td>';
            echo '<td>' . $book->getTitle() . '</td>';
            echo '<td>' . $book->getAuthor() . '</td>';
            echo '<td>' . $book->getDescription() . '</td>';
            echo '<td><button onclick="viewSample(' . $book->getId() . ')">View Sample</button></td>';
            echo '<td>' . $book->getPrice() . '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    ?>
    
    <script>
        function viewSample(bookid) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('sampleBody').innerHTML = xhr.responseText;
                }
            };
    
            xhr.open('POST', 'book_sample.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + bookid);
    
            document.getElementById('sampleModal').style.display = 'block';
        }
    </script>
    
    <div id="sampleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="sampleBody"></div>
        </div>
    </div>
    </body>
</html>
