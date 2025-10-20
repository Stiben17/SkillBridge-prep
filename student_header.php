<?php
session_start();

// Security check: Ensure user is logged in and is a 'student'
//if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
   // header("Location: ../config/login.php"); // Redirect to login page
  //  exit();
//}

// Include database connection
include_once __DIR__ . '/../config/conn.php'; // Use relative path
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <!-- Link CSS using relative URL path -->
    <link rel="stylesheet" type="text/css" href="../config/css/style.css">
</head>
<body>
