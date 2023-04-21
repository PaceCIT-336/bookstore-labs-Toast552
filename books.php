<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'login.php';

// Connect to database using PDO
$dsn = 'mysql:host=localhost;dbname=mydatabase';
$username = 'myusername';
$password = 'mypassword';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Function to sanitize user input
function sanitize($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

// Function to obtain user IP address
function getUserIP() {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    // Obtain user IP address
    $ip = getUserIP();
    echo "User IP: " . $ip; // Debug statement

    // Prepare and execute the SQL statement using a prepared statement
    $stmt = $pdo->prepare("SELECT CustomerID, FirstName, LastName, Password FROM Customers WHERE Email=:email AND IP=:ip");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();

    // Verify user credentials
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        if (password_verify($password, $row['Password'])) {
            // Set session variables and redirect to homepage
            session_start();
            $_SESSION['name'] = $row['FirstName'] . ' ' . $row['LastName'];
            $_SESSION['id'] = $row['CustomerID'];
            header("Location: index.php");
            exit();
        } else {
            // Display error message for incorrect password
            echo "Invalid email or password. Please try again.";
        }
    } else {
        // Display error message for incorrect email
        echo "Invalid email or password. Please try again.";
    }
}

// Generate hashed passwords
$password1 = password_hash('Charlie123', PASSWORD_DEFAULT);
$password2 = password_hash('Smokes123', PASSWORD_DEFAULT);

// Update passwords for a specific user using prepared statements
try {
    $id = 1;
    $stmt = $pdo->prepare("UPDATE Customers SET Password=:password, IP=:ip WHERE CustomerID=:id");
    $stmt->bindParam(':password', $password1);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':ip', getUserIP());
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE Customers SET Password=:password
