<?php 
include __DIR__ . '/student_header.php';       // header in the same folder
include __DIR__ . '/student_sidebar.php';      // sidebar in the same folder
?>

<div class="main-content">
    <?php include __DIR__ . '/../config/top_bar.php';
 ?>

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

<?php 
include __DIR__ . '/../config/footer.php';
?>