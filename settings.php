<?php
// ----------------------------
// DATABASE CONNECTION

$servername = "localhost";
$username = "root";   // your DB username
$password = "";       // your DB password
$dbname = "skillbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




// Fetch only the admin row
$sql = "SELECT * FROM login WHERE role='admin' LIMIT 1";
$result = $conn->query($sql);
$login = $result->fetch_assoc();

if (!$login) {
    die("Admin settings not found!");
}


// ----------------------------
// UPDATE SETTINGS
// ----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $admin_code = $_POST['admin_code'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $id = $login['id'];

    // Use prepared statement for safety
    $stmt = $conn->prepare("UPDATE login SET name=?, email=?, admin_code=?, password=?, phone_number=? WHERE id=?");
    $stmt->bind_param("ssssii", $name, $email, $admin_code, $password, $phone_number, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert(' Settings updated successfully!'); window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert(' Error updating settings: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: #fff;
            width: 60%;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            margin-top: 18px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
         .brand-header { width:100%; background:#007bff; 
            color:white; 
            padding:20px 40px; 
            display:flex; 
            justify-content:space-between;
             position:fixed;
              top:0; box-shadow:0 4px 10px rgba(0,0,0,0.1); 
              z-index:100;}
    .brand-header .logo { font-size:24px; font-weight:bold;}
    </style>
</head>
<body>
<div class="brand-header">
    <div class="logo">SkillBridge</div>
  </div> 
   
<div class="container">
    <h2> Admin Settings</h2>
    <form method="POST">
        <label> Name:</label>
        <input type="text" name="name" 
               value="<?= htmlspecialchars($login['name'] ?? '') ?>" required>

        <label>Admin Email:</label>
        <input type="email" name="email" 
               value="<?= htmlspecialchars($login['email'] ?? '') ?>" required>

        <label>Admin code:</label>
        <input type="text" name="admin_code" 
               value="<?= htmlspecialchars($login['admin_code'] ?? '') ?>" required>
        <label>Phone Number:</label>
        <input type="text" name="phone_number" 
               value="<?= htmlspecialchars($login['phone_number'] ?? '') ?>" required>


        <label>password:</label>
        <textarea name="password" rows="3"><?= htmlspecialchars($login['password'] ?? '') ?></textarea>

        <button type="submit" name="update"> Save Settings</button>
    </form>

    <a href="Admin_Dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>