<?php 
include __DIR__ . '/student_header.php';       // header in the same folder
include __DIR__ . '/student_sidebar.php';      // sidebar in the same folder
?>

<div class="main-content">
  <div class="topbar">
    <h2>Welcome, <?php //echo htmlspecialchars($_SESSION['name']); ?> 👋</h2>
    <form action="logout.php" method="POST">
        <button class="logout-btn">Logout</button>
    </form>
</div>
    <div class="content-wrapper">
        <h2>Student Dashboard</h2>
        <p>Welcome! You can access your courses, download certificates, and find new instructors here.</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Enrolled Courses</h3>
            <p>3</p> </div>
        <div class="card">
            <h3>Completed Courses</h3>
            <p>1</p>
        </div>
        <div class="card">
            <h3>Certificates Earned</h3>
            <p>1</p>
        </div>
    </div>
</div>

