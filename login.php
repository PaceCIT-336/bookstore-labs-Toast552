<?php
$data = 'bookstore';
$user = 'webapp'; //this is the user you created for lab 3 step 6
$pass = ''; //the password you set in lab 3 step 6

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$data", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
