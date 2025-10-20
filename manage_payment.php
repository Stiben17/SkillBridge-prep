<?php
// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";   // your DB username
$password = "";       // your DB password
$dbname = "skillbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// --- ADD PAYMENT ---
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $status = $_POST['status'];

    $sql = "INSERT INTO payments (name, amount, payment_date, payment_method, status)
            VALUES ('$name', '$amount', '$payment_date', '$payment_method', '$status')";
    $conn->query($sql);
}

// --- DELETE PAYMENT ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM login WHERE id=$id");
}

// --- FETCH ALL PAYMENTS ---
$result = $conn->query("SELECT * FROM login ORDER BY payment_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Payments</title>
    <style>
        body {
            font-family: Arial;
            background: #f9f9f9;
            margin: 20px;
        }
        h2 { text-align: center; color: #333; }
        form, table {
            margin: auto;
            width: 80%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            margin-top: 30px;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background: #218838; }
        .delete-btn {
            background: #dc3545;
        }
        .delete-btn:hover {
            background: #c82333;
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
    </br>
    </br>
    </br>
    
<h2> Manage Payments</h2>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Amount:</label>
    <input type="number" step="0.01" name="amount" required>
    <label>Date:</label>
    <input type="date" name="payment_date" required>
    <label>Method:</label>
    <select name="payment_method">
        <option>UPI</option>
        <option>Card</option>
        <option>Google Pay</option>
        <option>Bank Transfer</option>
    </select>
    <label>Status:</label>
    <select name="status">
        <option>Pending</option>
        <option>Completed</option>
        <option>Failed</option>
    </select>
    <button type="submit" name="add">Add Payment</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Method</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= number_format($row['amount'], 2) ?></td>
        <td><?= $row['payment_date'] ?></td>
        <td><?= $row['payment_method'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="?delete=<?= $row['id'] ?>" 
               onclick="return confirm('Delete this record?');">
               <button class="delete-btn">Delete</button>
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>