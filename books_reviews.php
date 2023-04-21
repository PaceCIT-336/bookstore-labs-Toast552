<?php

require_once 'login.php';

// Connect to the database
$pdo = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the table
try {
    $pdo->exec("CREATE TABLE books_reviews (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        book_id INT UNSIGNED NOT NULL,
        review TEXT NOT NULL,
        rating TINYINT UNSIGNED NOT NULL,
        reviewer_name VARCHAR(255) NOT NULL,
        reviewer_email VARCHAR(255) NOT NULL,
        review_date DATE NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;");
    echo "Table 'books_reviews' created successfully.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
