<?php
session_start();    // Initialize the session
session_unset();    // Unset all session variables
session_destroy();  // Destroy the session
header("Location: config/login.php"); // Redirect to login page inside config folder
exit();
?>
