<?php
try {
    // Connection parameters
    $host = 'localhost';
    $dbname = 'my_database';
    $username = 'my_username';
    $password = 'my_password';

    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Prepare a statement
    $stmt = $pdo->prepare('SELECT * FROM my_table WHERE id = :id');

    // Bind a value to a parameter
    $id = 1;
    $stmt->bindParam(':id', $id);

    // Execute the statement
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Do something with the results
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}
