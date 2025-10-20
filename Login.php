<?php
session_start();


$servername = "localhost";
$username = "root";   // your DB username
$password = "";       // your DB password
$dbname = "skillbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $login = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $login['password'])) {
           $_SESSION['username'] = $login['username'];
            $_SESSION['name'] = $login['name'];
            $_SESSION['role'] = $login['role'];

            // Redirect based on role
            if ($login['role'] === 'student') {
                header("Location: Student_dashboard.php");
               
            } elseif ($login['role'] === 'teacher') {
                header("Location: Teacher_dashboard.PHP");
            } elseif ($login['role'] === 'admin') {
                header("Location: Admin_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No account found with that email.";
    }
        
    $stmt->close();
}



?>
<!DOCTYPE html>


<head >
    <title></title>
    <style type="text/css">

        
        .auto-style1 {
            font-size: xx-large;
            margin-left: 200px;
        }
        
        .auto-style2 {
            font-size: large;
            margin-left: 200px;
        }
    </style>

    <style>
        input, select, button {
            display: block;
            
            padding: 10px;
            margin-bottom: 8px;
            margin-left: 225px;
        }
.signin-btn {
    background-color: #007BFF; /* Blue color */
    color: white;
    border: none;
    padding: 10px 40px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    margin-left: 275px;
}
.signin-btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
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
</style>
</head>
<body>
    <div class="topbar">
            <h1>SkillBridge Prep </h1>
            
        </div>
    <form method="post" action="">
        <div>
            <br />
            <br />
            <br />
            <br />
            <strong><span class="auto-style1"> Let&#39;s Catch Big Dreams!</span></strong><br />
 &nbsp; <span class="auto-style2">Pursue your dreams passionately and strive</span></strong><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="auto-style2">to achive your goals every day</span></strong><br />
            <br />
            <strong><span class="auto-style2">Username</span></strong><br />

            <input type="text" name="username" placeholder="Username" style="width: 250px;height: 8px;" required>
            
            <strong><span class="auto-style2"> Email</span></strong><br />

            <input type="text" name="email" placeholder="Email" style="width: 250px;height: 8px;"required>
           
            <strong><span class="auto-style2">Password</span></strong><br />
            <input type="password" name="password" placeholder="Password" style="width: 250px;height: 8px;"required>
            
            <a class="auto-style2" href="forgot_password.php">Forgot Password?</a>
            
            
            <button type="submit" name="login"  class="signin-btn">Sign In</button> 
            

     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span class="auto-style2">Don&#39;t have an account?
           <a href="Signup.php" > Sign Up</a></span></strong>
<?php if(!empty($error)) { echo '<p style="color:red;text-align:center;">'.$error.'</p>'; } ?>
            <br />
            <br />
            <br />
            <br />
        </div>
    </form>
</body>
</html>
