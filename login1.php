<?php
session_start();

// Temporary credentials
$USERNAME = "student";
$PASSWORD = "1234";

// Check if form is submitted
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $USERNAME && $pass === $PASSWORD) {
        // Set session and redirect to dashboard
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'student';
        header("Location: student/student_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Skill Bridge - Login</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        width: 320px;
        text-align: center;
    }
    h2 { margin-bottom: 20px; }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }
    button:hover { background: #0056b3; }
    .error { color: red; margin-top: 10px; }
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <p style="margin-top:15px; font-size: 0.9rem;">Temporary login: <b>student / 1234</b></p>
</div>

</body>
</html>