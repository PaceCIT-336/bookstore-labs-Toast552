<?php
session_start();
if(session_destroy()) {
  // Unset all session variables
  $_SESSION = array();

  // Delete session cookie
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }
  
  // Log logout timestamp and geolocation data
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $geodata = json_decode(file_get_contents("https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY_HERE&ip={$ip_address}"));
  $timestamp = date("Y-m-d H:i:s");
  $log_message = "User with IP address {$ip_address} and geolocation data (City: {$geodata->city}, Country: {$geodata->country_name}, Latitude: {$geodata->latitude}, Longitude: {$geodata->longitude}) logged out at {$timestamp}.";
  error_log($log_message, 0);

  // Redirect to login page
  header("Location: index.php");
  exit();
} else {
  // Handle session destruction error
  echo "Error: Unable to destroy session. Please try again.";
}
?>
