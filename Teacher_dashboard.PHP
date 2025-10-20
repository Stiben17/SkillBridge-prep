<?php 
// Include header and sidebar from the same folder
include __DIR__ . '/teacher_header.php'; 
include __DIR__ . '/teacher_sidebar.php'; 
?>

<div class="main-content">
 
<div class="topbar">
    <h2>Welcome, <?php //echo htmlspecialchars($_SESSION['name']); ?> 👋</h2>
    <form action="logout.php" method="POST">
        <button class="logout-btn">Logout</button>
    </form>
</div>
    <div class="content-wrapper">
        <h2>Teacher Dashboard</h2>
        <p>Welcome to your panel. You can manage your student's mock tests, review performance, and track payments from here.</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Your Students</h3>
            <p>15</p>
        </div>
        <div class="card">
            <h3>Active Mock Tests</h3>
            <p>4</p>
        </div>
        <div class="card">
            <h3>Pending Reviews</h3>
            <p>3</p>
        </div>
    </div>
</div>

