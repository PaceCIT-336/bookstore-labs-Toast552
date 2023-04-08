<?php
require_once 'login.php';
session_start();

function sanitize($conn, $var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $conn->real_escape_string($var);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($pdo, $_POST['email']);
    $password = sanitize($pdo, $_POST['password']);
    $query = "SELECT CustomerID, FirstName, LastName, Password FROM Customers WHERE Email='$email'";
    $result = $pdo->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['name'] = $row['FirstName'] . ' ' . $row['LastName'];
            $_SESSION['id'] = $row['CustomerID'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Invalid email or password. Please try again.";
    } 
}

$password1 = password_hash('Charlie123', PASSWORD_DEFAULT);
$password2 = password_hash('Smokes123', PASSWORD_DEFAULT);

// Create a PDO connection
$dsn = 'mysql:host=localhost;dbname=mydatabase';
$username = 'myusername';
$password = 'mypassword';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Prepare the SQL statement
$sql = "UPDATE Customers SET Password=:password1, Password2=:password2 WHERE CustomerID=:id";
$stmt = $pdo->prepare($sql);

// Bind the parameters
$stmt->bindParam(':password1', $password1);
$stmt->bindParam(':password2', $password2);
$stmt->bindParam(':id', $id);

// Set the customer ID
$id = 1;

// Execute the statement
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Authentication Form</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Log In">
    </form>
</body>
</html>
