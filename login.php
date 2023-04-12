<?php
// Database credentials
$data = 'bookstore';
$user = 'webapp'; // this is the user you created for lab 3 step 6
$pass = ''; // the password you set in lab 3 step 6

try {
    // Establish a PDO database connection
    $pdo = new PDO("mysql:host=localhost;dbname=$data", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sanitize and validate user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Prepare and execute a parameterized SQL query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    // Fetch the first row from the query result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful, start session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to protected page
        header("Location: welcome.php");
        exit();
    } else {
        // Authentication failed, redirect to login page with error message
        header("Location: login.php?error=InvalidCredentials");
        exit();
    }
} catch (PDOException $e) {
    // Error occurred, display error message
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
