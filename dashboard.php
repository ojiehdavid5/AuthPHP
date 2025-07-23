<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?= htmlspecialchars($user) ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
