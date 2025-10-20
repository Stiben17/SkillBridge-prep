<?php
session_start();

// Security Check: Ensure user is logged in and is a 'teacher'
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
//     header("Location: ../config/login.php");
//     exit();
// }

// Include database connection
include_once __DIR__ . '/../config/conn.php'; // use relative path
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <!-- Link CSS using relative URL path -->
    <link rel="stylesheet" type="text/css" href="../config/css/style.css">
</head>
<body>
