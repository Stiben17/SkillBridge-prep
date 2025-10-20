<?php
// Start session and check if user is logged in
session_start();

// If user is not logged in or not admin, redirect to login page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #333;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main Content */
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            align-items: center;
            border-radius: 4px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            flex: 1;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b52a37;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="Admin_dashboard.php">Dashboard</a>
        <a href="manage_students.php">Manage Students</a>
        <a href="manage_teacher.php">Manage Teachers</a>
        <a href="manage_payment.php"> Manage Payment</a>
        <a href="settings.php"> Settings</a>
        <a href="logout.php" style="color: #ff4d4d;">Logout</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="topbar">
            <h2>Welcome, <?php echo $_SESSION['name']; ?> </h2>
            <form action="logout.php" method="POST">
                <button class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Students</h3>
                <p>
                    <?php
                    $servername = "localhost";
                    $username = "root";   // your DB username
                    $password = "";       // your DB password
                    $dbname = "skillbridge";

                    $conn =  mysqli_connect($servername, $username, $password, $dbname);

                    if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    }
                    $result = $conn->query("SELECT COUNT(*) AS total FROM login WHERE role='student'");
                    $row = $result->fetch_assoc();
                    echo $row['total'];
                    ?>
                </p>
            </div>

            <div class="card">
                <h3>Total Teachers</h3>
                <p>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS total FROM login WHERE role='teacher'");
                    $row = $result->fetch_assoc();
                    echo $row['total'];
                    ?>
                </p>
            </div>

            <div class="card">
                <h3>Total Admins</h3>
                <p>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS total FROM login WHERE role='admin'");
                    $row = $result->fetch_assoc();
                    echo $row['total'];
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
