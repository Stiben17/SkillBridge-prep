<?php
// Determine protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";

// Get the host
$host = $_SERVER['HTTP_HOST'];

// Set the correct path to your dashboard (adjust 'skillbridge/dashboard/' if needed)
$path = '/skillbridge/Welcomepage.php/';

// Redirect
header('Location: ' . $protocol . $host . $path);
exit;
?>
