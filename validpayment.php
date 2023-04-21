<?php
// define variables and set to empty values
$nameErr = $emailErr = $cardErr = $cvvErr = "";
$name = $email = $card = $cvv = "";

function fix_string($string) {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
}

function validate_name($field) {
    if ($field == "") return "Name is required<br>";
    return "";
}

function validate_email($field) {
    if ($field == "") return "Email is required<br>";
    else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $field))
        return "Invalid email format<br>";
    return "";
}

function validate_card($field) {
    if ($field == "") return "Credit card number is required<br>";
    else if (!preg_match("/^[0-9]{16}$/", $field))
        return "Invalid credit card number<br>";
    return "";
}

function validate_cvv($field) {
    if ($field == "") return "CVV is required<br>";
    else if (!preg_match("/^[0-9]{3}$/", $field))
        return "Invalid CVV number<br>";
    return "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = fix_string($_POST["name"]);
    $email = fix_string($_POST["email"]);
    $card = fix_string($_POST["card"]);
    $cvv = fix_string($_POST["cvv"]);

    $nameErr .= validate_name($name);
    $emailErr .= validate_email($email);
    $cardErr .= validate_card($card);
    $cvvErr .= validate_cvv($cvv);

    $fail = $nameErr.$emailErr.$cardErr.$cvvErr;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment Information</title>
</head>
<body>

	<h2>Payment Information</h2>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($fail == "") {
			echo "<p>Thank you for your payment!</p>";
			echo "<p>Name: " . $name . "</p>";
			echo "<p>Email: " . $email . "</p>";
			echo "<p>Credit Card: " . $card . "</p>";
			echo "<p>CVV: " . $cvv . "</p>";
		} else {
			echo "<p>Please correct the following errors:</p>";
			echo "<ul>" . $fail . "</ul>";
		}
	}
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="name">Full Name:</label><br>
		<input type="text" id="name" name="name" value="<?php echo $name;?>" required><br>

		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" value="<?php echo $email;?>" required><br>

		<label for="card">Credit Card Number:</label><br>
		<input type="text" id="card" name="card" value="<?php echo $card;?>" required><br>

		<label for="cvv">CVV:</label><br>
		<input type="text" id="cvv" name="cvv" value="<?php echo $cvv;?>" required><br>

		<input type="submit" value="Submit">
	</form>

