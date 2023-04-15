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

<script>
  function validateForm() {
    // Perform form validation using JavaScript
    // Add your custom validation logic here
    // Return true if validation passes, false otherwise
    return true;
  }
  
  // Example: Attach the form validation function to the form's submit event
  var form = document.querySelector('form');
  form.addEventListener('submit', function(event) {
    if (!validateForm()) {
      event.preventDefault(); // Prevent form submission if validation fails
    }
  });
</script>
