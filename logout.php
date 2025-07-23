<?php
session_start();
session_unset();
session_destroy();

// Clear cookie
setcookie("user", "", time() - 3600);

header("Location: index.php");
exit;
>