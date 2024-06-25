<?php
session_start();
session_unset();
session_destroy();
setcookie("last_visited_posts", "", time() - 3600, "/");

header("Location: ../../index.php");
exit();
?>