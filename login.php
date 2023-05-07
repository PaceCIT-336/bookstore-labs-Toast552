<?php
$data = 'bookstore';
$user = 'John Doe';
$pass = 'X'; 

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
