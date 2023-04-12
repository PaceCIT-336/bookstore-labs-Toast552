<?php
// Database credentials
$data = 'bookstore';
$user = 'webapp'; // this is the user you created for lab 3 step 6
$pass = ''; // the password you set in lab 3 step 6

try {
    // Establish a PDO database connection
    $pdo = new PDO("mysql:host=localhost;dbname=$data", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the Purchases table
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Purchases (
        PurchaseID INT UNSIGNED NOT NULL AUTO_INCREMENT,
        BookID INT UNSIGNED NOT NULL,
        CustomerID INT UNSIGNED NOT NULL,
        OrderDate DATE NOT NULL,
        PRIMARY KEY (PurchaseID),
        FOREIGN KEY (BookID) REFERENCES Books(BookID),
        FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
    ) ENGINE=InnoDB");
    $stmt->execute();

    // Insert data into the Purchases table
    $stmt = $pdo->prepare("INSERT INTO Purchases (BookID, CustomerID, OrderDate) VALUES (?, ?, ?), (?, ?, ?)");
    $stmt->execute([1, 1, '2022-01-01', 2, 2, '2022-01-02']);

    // Display success message
    echo "Data inserted successfully!";
} catch (PDOException $e) {
    // Error occurred, display error message
    die("ERROR: " . $e->getMessage());
}
?>
