<?php
// signup.php

$servername = "localhost";
$username = "root";   // your DB username
$password = "";       // your DB password
$dbname = "skillbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $username = $_POST['username'];
    $phone_number = intval($_POST['phone_number']);
    $experience =intval($_POST['experience']);
    $admin_code = $_POST['admin_code'];
    $subject = '';

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM login WHERE email = ?"); 
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered.');</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO login (name, email, password, role, phone_number, subject, experience, admin_code, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisiss", $name, $email, $password, $role, $phone_number, $subject, $experience, $admin_code, $username);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! You can now log in.');</script>";
        } else {
            echo "<script>alert('Error during signup.');</script>";
        }
    }

    $stmt->close();
    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    <style type="text/css">
        
        
        input, select, button {
            display: block;
            
            padding: 10px;
            margin-bottom: 8px;
            margin-left: 225px;
        }
        button {
            background-color: #007bff; color: white; border: none;
           
    margin-left: 275px;
    padding: 10px 40px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
        }
         .auto-style1 {
     font-size: xx-large;
     margin-left: 200px;
        }
 
        .auto-style2 {
     font-size: large;
     margin-left: 200px;
         }
        .extra-field {display: none;}
        .topbar {
            display: flex;
            justify-content: space-between;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            align-items: center;
            border-radius: 4px;
        }
    </style>

    <script>
        function showExtraFields() {
            const role = document.getElementById("role").value;

            // Hide all role-specific sections
             document.getElementById("signupFields").style.display = "block";
            document.getElementById("studentFields").style.display = "none";
            document.getElementById("teacherFields").style.display = "none";
            document.getElementById("adminFields").style.display = "none";
            
            // Show the selected one
             if (role === "student") {
                document.getElementById("studentFields").style.display = "block";
            } else if (role === "teacher") {
                document.getElementById("teacherFields").style.display = "block";
            } else if (role === "admin") {
                document.getElementById("adminFields").style.display = "block";
            }
       
        }
         window.onload =function(){showExtraFields();}
    </script>
</head>
<body>
    <div class="topbar">
            <h1>SkillBridge Prep </h1>
            
        </div>
    <form method="POST" action="">
        <h2></h2>
                <div style="height: 919px">
                    <div id="signupFields">
            <br />
            <br />
            <br />
            <br />
            <br />
         <strong><span class="auto-style1"> Let&#39;s Catch Big Dreams!<br /></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="auto-style2"></span>Pursue your dreams passionately and strive</span></strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="auto-style2"></span> to achive your goals every day<br /></span></strong>
            <br />

        <strong><span class="auto-style2">Full&nbsp; Name</span></strong>
        <input type="text" name="name" placeholder="Full Name" required style="width: 250px;height: 10px;">
        <strong><span class="auto-style2">Username</span></strong>
        <input type="text" name="username" placeholder="User Name" required style="width: 250px;height: 10px;">
        <strong><span class="auto-style2"> Email</span></strong>
        <input type="email" name="email" placeholder="Email Address" required style="width: 250px;height: 10px;">
        <strong><span class="auto-style2"> Password</span></strong>
        <input type="password" name="password" placeholder="Password" required style="width: 250px;height: 10px;">
        <strong><span class="auto-style2">Role Selection</span></strong>
        <select name="role" id="role" onchange="showExtraFields()" style="width: 250px;height: 10px;" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
        </select>
                    </div>

                <!-- Student extra fields -->
        <div id="studentFields" class="extra-fields">
            <strong><span class="auto-style2"> Phone Number</span></strong>
            <input type="text" name="Phone_number" placeholder="Phone number"style="width: 250px;height: 10px;">
           
        </div>

        <!-- Teacher extra fields -->
        <div id="teacherFields" class="extra-fields">
            <strong><span class="auto-style2"> Phone Number</span></strong>
            <input type="text" name="phone_number" placeholder="Phone number"style="width: 250px;height: 10px;">
            <strong><span class="auto-style2"> Subject</span></strong>
            <input type="text" name="subject" placeholder="Subject Taught"style="width: 250px;height: 10px;">
            <strong><span class="auto-style2"> Experience in years</span></strong>
            <input type="text" name="experience" placeholder="Experience"style="width: 250px;height: 10px;">
        </div>

        <!-- Admin extra fields -->
        <div id="adminFields" class="extra-fields">
            <strong><span class="auto-style2"> Admin code</span></strong>
            <input type="text" name="admin_code" placeholder="Admin Code"style="width: 250px;height: 10px;">
        </div>
<div id="signupFields">
        <button type="submit">Sign Up</button>
        </div> 
        </div> 
     </form>    
      
</body>


</html>


    