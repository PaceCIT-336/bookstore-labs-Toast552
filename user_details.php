<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require_once 'login.php'; 

// Find if a customer is logged in
$id = NULL;
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    // If not logged in, redirect to login page
    header("Location: authenticate.php");
}

// Initialize variables for user details
$firstName = $lastName = $address = $email = $phone = "";

// Query database for user details
// ...

// Initialize array for purchase history
$purchases = array();

// Query database for purchase history
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT BOOKID, order_date FROM purchases WHERE customer_id = $id";
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $purchases[] = $row;
}
$result->close();
$conn->close();

?>

<head>
    <meta charset="utf-8">
    <title>Rainy Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
    
    <!-- Import React and Babel -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Import React component and render to the user div -->
    <script type="text/babel" src="assets/react/script.js"></script>
    <script type="text/babel">
        doRender(
            <UserPage 
                firstName="<?php echo $firstName; ?>"
                lastName="<?php echo $lastName; ?>"
                address="<?php echo $address; ?>"
                email="<?php echo $email; ?>"
                phone="<?php echo $phone; ?>"
                purchases={<?php echo json_encode($purchases); ?>}
            />,
            'user'
        );
    </script>
</head>
<!-- Don't change anything below here! React should handle the display -->
<body>
    <div id="user"></div>
</body>
</html>
