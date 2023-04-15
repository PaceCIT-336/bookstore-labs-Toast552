<?php
    // PHP code here

    // Function to fix string and strip HTML entities
    function fix_string($string) {
        // Add your implementation for fixing the string here
        // For example, you can use htmlentities function:
        return htmlentities($string);
    }

    // Function to validate full name
    function validateFullName($fullName) {
        if (empty($fullName)) {
            return "Full Name is required.";
        }
        return "";
    }

    // Function to validate email
    function validateEmail($email) {
        if (empty($email)) {
            return "Email is required.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email format is incorrect.";
        }
        return "";
    }

    // Function to validate credit card number
    function validateCreditCardNumber($creditCardNumber) {
        if (empty($creditCardNumber)) {
            return "Credit Card Number is required.";
        } else if (!preg_match('/^[0-9]{16}$/', $creditCardNumber)) {
            return "Credit Card Number must be 16 digits.";
        }
        return "";
    }

    // Function to validate CVV
    function validateCVV($cvv) {
        if (empty($cvv)) {
            return "CVV is required.";
        } else if (!preg_match('/^[0-9]{3}$/', $cvv)) {
            return "CVV must be 3 digits.";
        }
        return "";
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["fullName"])) {
        // Retrieve form data
        $fullName = fix_string($_POST["fullName"]);
        $email = fix_string($_POST["email"]);
        $creditCardNumber = fix_string($_POST["creditCardNumber"]);
        $cvv = fix_string($_POST["cvv"]);

        // Validate each input and store errors in $fail variable
        $fail = "";
        $fail .= validateFullName($fullName);
        $fail .= validateEmail($email);
        $fail .= validateCreditCardNumber($creditCardNumber);
        $fail .= validateCVV($cvv);

        // If there are no errors, process payment information
        if (empty($fail)) {
            // Perform processing of payment information
            // Add your processing logic here

            // Debugging: Display success message
            echo "Payment information submitted successfully!";
        } else {
            // Debugging: Display error messages
            echo "Errors found: " . $fail;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Information</title>
</head>
<body>
    <h1>Payment Information</h1>
    <form method="post" action="">
        <label for="fullName">Full Name:</label><br>
        <input type="text" id="fullName" name="fullName" required placeholder="Enter Full Name" value="<?php echo isset($fullName) ? $fullName : '' ?>"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required placeholder="Enter Email" value="<?php echo isset($email) ? $email : '' ?>"><br><br>
        <label for="creditCardNumber">Credit Card Number:</label><br>
        <input type="text" id="creditCardNumber" name="creditCardNumber" required placeholder="Enter Credit Card Number" value="<?php echo isset($creditCardNumber) ? $creditCardNumber : '' ?>"><br
