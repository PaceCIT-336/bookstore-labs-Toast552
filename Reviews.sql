<?php
// Database credentials
$data = 'bookstore';
$user = 'webapp'; // this is the user you created for lab 3 step 6
$pass = ''; // the password you set in lab 3 step 6

try {
    // Establish a PDO database connection
    $pdo = new PDO("mysql:host=localhost;dbname=$data", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the Reviews table
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Reviews (
        ReviewID INT AUTO_INCREMENT PRIMARY KEY,
        BookID INT NOT NULL,
        CustomerID INT,
        Rating INT NOT NULL,
        Review TEXT,
        FOREIGN KEY (BookID) REFERENCES Books(BookID),
        FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
    )");
    $stmt->execute();

    // Insert data into the Reviews table
    $stmt = $pdo->prepare("INSERT INTO Reviews (BookID, Rating, Review) VALUES (?, ?, ?)");
    $stmt->execute([1, 5, "Great book!"]);

    // Display success message
    echo "Data inserted successfully!";
} catch (PDOException $e) {
    // Error occurred, display error message
    die("ERROR: " . $e->getMessage());
}
?>
