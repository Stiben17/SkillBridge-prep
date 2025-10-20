<?php
// ---------- DATABASE CONNECTION ----------
$servername = "localhost";
$username = "root";      // change if needed
$password = "";          // change if needed
$dbname = "skillbridge";      // change to your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ---------- ADD OR EDIT TEACHER ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Add new teacher
    if (isset($_POST['add_login'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $subject = $_POST['subject'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("INSERT INTO login (name, email, phone_number, subject, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $phone_number, $subject, $role);
        $stmt->execute();
        $stmt->close();
    }

    // Edit existing teacher
    if (isset($_POST['edit_login'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $subject = $_POST['subject'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE login SET name=?, email=?, phone_number=?, subject=?, role=? WHERE id=?");
        $stmt->bind_param("ssissi", $name, $email, $phone_number, $subject, $role, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// ---------- DELETE TEACHER ----------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM login WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// ---------- FETCH TEACHERS ----------
$result = $conn->query("SELECT * FROM login ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <div class="topbar">
            <h1>SkillBridge Prep </h1>
            
        </div>
    <meta charset="UTF-8">
    <title>Manage Teachers</title>
   <style> .topbar {
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
    <h2>Manage Teachers</h2>

    <!-- Add Teacher Form -->
    <form method="POST">
        <fieldset style="width: 600px;">
            <legend>Add New Teacher</legend>
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Phone Number:</label><br>
            <input type="text" name="phone_number" required><br><br>

            <label>Subject:</label><br>
            <input type="text" name="subject" required><br><br>

             <label>role:</label><br>
            <input type="text" name="role" value="teacher"><br><br>

            <input type="submit" name="add_login" value="Add Teacher">
        </fieldset>
    </form>

    <hr>

    <!-- Teacher List -->
    <h3> List</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr style="background-color:#ddd;">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>role</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                 <td><?php echo htmlspecialchars($row['role']); ?></td>
                <td>
                    <!-- Edit Form (inline) -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($row['phone_number']); ?>" required>
                        <input type="text" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" required>
                        <input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" required>
                        <input type="submit" name="edit_login" value="Save">
                    </form>
                    <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this teacher?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>