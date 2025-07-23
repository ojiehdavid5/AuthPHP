<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'users.php';
?>

<?php
session_start();
include 'users.php';

$errors = [];
$email = '';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $remember = isset($_POST["remember"]);

    if (empty($email) || empty($password)) {
        $errors[] = "Email and password are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif (!isset($users[$email]) || $users[$email] !== $password) {
        $errors[] = "Invalid credentials.";
    } else {
        $_SESSION["user"] = $email;

        if ($remember) {
            setcookie("user", $email, time() + 86400); // 1 day
        }

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>

    <?php if ($errors): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>
            <input type="checkbox" name="remember" <?= isset($_POST["remember"]) ? 'checked' : '' ?>> Remember me
        </label><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
