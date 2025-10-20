<?php
// ---------------------
// Database Connection
// ---------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skillbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// ---------------------
// Handle Add / Edit Student
// ---------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_login'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $subject = $_POST['subject'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("INSERT INTO login (name, email, phone_number, subject, role) VALUES (?, ?, ?,?, ?)");
        $stmt->bind_param("ssiss",$name,$email,$phone_number,$subject, $role);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['edit_login'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $subject = $_POST['subject'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE login SET name=?, email=?, phone_number=?, subject=?, role=? WHERE id=?");
        $stmt->bind_param("ssissi",$name,$email,$phone_number,$subject,$role,$id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['pay_stud'])) {
        $id = $_POST['id'];
        $amount = $_POST['amount'];
        // Here you can integrate your payment gateway (Stripe/Razorpay)
        $payment_message = "Payment of ₹$amount initiated for student ID $id!";
    }
}

// ---------------------
// Handle Delete
// ---------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM login WHERE id=$id");
}

// ---------------------
// Fetch all students
// ---------------------
$login = $conn->query("SELECT * FROM login ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard & Payment Portal</title>

<style>
    * { box-sizing: border-box; margin:0; padding:0; font-family:'Roboto',sans-serif; }
    body { background:#f5f5f5; }
    .brand-header { width:100%; background:#007bff; color:white; padding:20px 40px; display:flex; justify-content:space-between; position:fixed; top:0; box-shadow:0 4px 10px rgba(0,0,0,0.1); z-index:100;}
    .brand-header .logo { font-size:24px; font-weight:bold;}
    .brand-header .tagline { font-size:16px; opacity:0.9;}
    .content { margin-top:100px; padding:20px; }
    h2 { color:#333; margin-bottom:10px;}
    table { width:100%; border-collapse:collapse; margin-bottom:20px;}
    th,td { padding:10px; border:1px solid #ccc; text-align:left;}
    th { background:#007bff; color:white;}
    a { text-decoration:none; color:#007BFF; margin-right:5px; }
    a.delete { color:red; }
    form { margin-bottom:20px; }
    input { padding:8px; margin:5px 0; width:200px; }
    button { padding:8px 15px; border:none; border-radius:6px; cursor:pointer; }
    button.add { background:#007bff; color:white; }
    button.edit { background:#007BFF; color:white; }
    button.pay { background:#FF9800; color:white; }
    .payment-message { color:green; font-weight:bold; margin-bottom:10px;}
</style>
</head>
<body>

<div class="brand-header">
    <div class="logo">SkillBridge</div>
    <div class="tagline">Manage Students & Payments</div>
</div>

<div class="content">
    <h2>Add New Student</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="subject" placeholder="subject">
          <input type="text" name="role" value="student">
        <button type="submit" name="add_login" class="add">Add Student</button>
    </form>

    <?php if(isset($payment_message)) { echo "<div class='payment-message'>$payment_message</div>"; } ?>

    <h2>List</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>role</th><th>Enroll Date</th><th>Actions</th>
        </tr>
        <?php while($row = $login->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'];?></td>
            <td><?= htmlspecialchars($row['name']);?></td>
            <td><?= htmlspecialchars($row['email']);?></td>
            <td><?= htmlspecialchars($row['phone_number']);?></td>
            <td><?= htmlspecialchars($row['subject']);?></td>
            <td><?= htmlspecialchars($row['role']);?></td>
            <td><?= $row['created_at'];?></td>
            <td>
                <!-- Edit Form -->
                <form method="POST" action="" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= $row['id'];?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($row['name']);?>" required>
                    <input type="email" name="email" value="<?= htmlspecialchars($row['email']);?>" required>
                    <input type="text" name="phone" value="<?= htmlspecialchars($row['phone_number']);?>">
                    <input type="text" name="subject" value="<?= htmlspecialchars($row['subject']);?>">
                     <input type="text" name="role" value="<?= htmlspecialchars($row['role']);?>">
                    <button type="submit" name="edit_login" class="edit">Update</button>
                </form>
                <a href="?delete=<?= $row['id'];?>" class="delete" onclick="return confirm('Delete this student?')">Delete</a>

                <!-- Payment Form -->
                <form method="POST" action="" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= $row['id'];?>">
                    <input type="number" name="amount" placeholder="₹ Amount" required>
                    <button type="submit" name="pay_stud" class="pay">Pay</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>