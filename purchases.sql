<?php
require_once 'login.php';

// Assuming $pdo is properly initialized with a PDO object

// Create Purchases table with proper data types and constraints
$query = "CREATE TABLE IF NOT EXISTS Purchases (
            PurchaseID INT UNSIGNED NOT NULL AUTO_INCREMENT,
            BookID INT UNSIGNED NOT NULL,
            CustomerID INT UNSIGNED NOT NULL,
            OrderDate DATE NOT NULL,
            PRIMARY KEY (PurchaseID),
            FOREIGN KEY (BookID) REFERENCES Books(BookID),
            FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
          ) ENGINE=InnoDB;";
$pdo->exec($query);

// Insert data into Purchases table using prepared statements for security
$query = "INSERT INTO Purchases (BookID, CustomerID, OrderDate) VALUES (?, ?, ?), (?, ?, ?)";
$stmt = $pdo->prepare($query);

// Bind parameter values to prepared statement
$stmt->bindValue(1, 1, PDO::PARAM_INT);
$stmt->bindValue(2, 1, PDO::PARAM_INT);
$stmt->bindValue(3, '2022-01-01', PDO::PARAM_STR);
$stmt->bindValue(4, 2, PDO::PARAM_INT);
$stmt->bindValue(5, 2, PDO::PARAM_INT);
$stmt->bindValue(6, '2022-01-02', PDO::PARAM_STR);

// Execute prepared statement
$stmt->execute();

?>
