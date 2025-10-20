<div class="topbar">
    <h2>Welcome, <?php //echo htmlspecialchars($_SESSION['name']); ?> 👋</h2>
    <form action="logout.php" method="POST">
        <button class="logout-btn">Logout</button>
    </form>
</div>