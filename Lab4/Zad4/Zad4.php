<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
</head>
<body>
<?php
$user_ip = $_SERVER['REMOTE_ADDR'];

$allowed_ips_file = 'lista_ip.txt';
function check_allowed_ip($ip, $file) {
    $allowed_ips = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($ip, $allowed_ips);
}

if (check_allowed_ip($user_ip, $allowed_ips_file)) {
    include 'specjalnaStrona.php';
} else {
    include 'domyslnaStrona.php';
}
?>

</body>
</html>