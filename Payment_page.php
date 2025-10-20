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



// --- FETCH ALL PAYMENTS ---
$result = $conn->query("SELECT * FROM login ORDER BY payment_date DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Portal</title>

<style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Roboto', sans-serif; }

    body { background: #f5f5f5; }

    /* Navbar / Brand header */
    .brand-header {
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 20px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
    }

    .brand-header .logo { font-size: 24px; font-weight: bold; }
    .brand-header .tagline { font-size: 16px; opacity: 0.9; }

    /* Main content below navbar */
    .content {
        margin-top: 100px; /* space for fixed header */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 100px);
        padding: 20px;
    }

    /* Payment container */
   
    .payment-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .payment-container label {
        display: block;
        margin: 10px 0 5px;
        color: #555;
        font-weight: 500;
    }

    .payment-container input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .payment-container button {
        width: 100%;
        padding: 15px;
         background-color: #007bff;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .payment-container button:hover { background-color: #218838; }

    
    

    .note {
        text-align: center;
        margin-top: 10px;
        color: #777;
        font-size: 13px;
    }

    /* Responsive for smaller screens */
    @media (max-width: 400px) {
        .payment-container { width: 90%; padding: 30px; }
        .brand-header { padding: 15px 20px; }
        .brand-header .logo { font-size: 20px; }
        .brand-header .tagline { font-size: 14px; }
    }
</style>
</head>
<body>

<!-- Brand Header -->
<div class="brand-header">
    <div class="logo">SkillBridge</div>
    <div class="tagline">Catch Big Dreams!</div>
</div>

<!-- Main Content -->
<div class="content">
    <div class="payment-container">
        <h2>Complete Payment</h2>

        <!-- Payment Form -->
        <form action="charge.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Full Name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="amount">Amount (INR)</label>
            <input type="number" id="amount" name="amount" placeholder="Amount" required>

            <label>Date:</label>
           <input type="date" name="payment_date" required>
           <label>Method:</label>
          <select name="payment_method">
                 <option>UPI</option>
                 <option>Card</option>
                 <option>Google Pay</option>
                  <option>Bank Transfer</option>
                </select>
</br></br>
            <button type="submit">Pay Now</button>
        </form>

        <p class="note">You will be redirected to a secure payment gateway.</p>
    </div>
</div>

</body>
</html>