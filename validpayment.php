<?php
// Function to sanitize input
function sanitize_input($input) {
    // Use PHP's filter_var function to sanitize input
    $input = filter_var($input, FILTER_SANITIZE_STRING);
    // Use htmlspecialchars to prevent HTML and script injections
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

// Function to validate email format
function validate_email($email) {
    // Use PHP's filter_var function with FILTER_VALIDATE_EMAIL flag to validate email format
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate credit card format
function validate_credit_card($credit_card) {
    // Use regular expression to validate credit card format
    // This regex ensures that the credit card number contains exactly 16 digits
    return preg_match("/^[0-9]{16}$/", $credit_card);
}

// Function to validate CVV format
function validate_cvv($cvv) {
    // Use regular expression to validate CVV format
    // This regex ensures that the CVV contains exactly 3 digits
    return preg_match("/^[0-9]{3}$/", $cvv);
}

// Check form submission
if (isset($_POST["submit"])) { // Check if form has been submitted
    // Get form inputs and sanitize them
    $full_name = sanitize_input($_POST["full_name"]);
    $email = sanitize_input($_POST["email"]);
    $credit_card = sanitize_input($_POST["credit_card"]);
    $cvv = sanitize_input($_POST["cvv"]);
    $password = sanitize_input($_POST["password"]);

    // Validate inputs
    $errors = array();

    if (empty($full_name)) {
        $errors[] = "Full name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!validate_email($email)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($credit_card)) {
        $errors[] = "Credit card number is required.";
    } elseif (!validate_credit_card($credit_card)) {
        $errors[] = "Invalid credit card number format.";
    }

    if (empty($cvv)) {
        $errors[] = "CVV is required.";
    } elseif (!validate_cvv($cvv)) {
        $errors[] = "Invalid CVV format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If no errors, proceed with database comparison
    if (empty($errors)) {
        // Use prepared statements to prevent SQL injection
        // Connect to database securely using PDO with prepared statements
        $dsn = "mysql:host=localhost;dbname=your_database_name;charset=utf8mb4";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false
        );

        try {
            $pdo = new PDO($dsn, 'your_username', 'your_password', $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

        // Prepare SQL statement with email as parameter
        $stmt = $pdo->prepare("SELECT CustomerID, FirstName, LastName, Password FROM customers WHERE Email = ?");
        $stmt->execute([$email]);

        // Fetch the row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if row exists
        if ($row) {
            // Verify password
