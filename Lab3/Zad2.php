<?php

function factorial_recursive($n) {
    if ($n == 0) {
        return 1;
    } else {
        return $n * factorial_recursive($n - 1);
    }
}

function factorial_non_recursive($n) {
    $result = 1;
    for ($i = 1; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

$num = isset($_GET['num']) ? $_GET['num'] : 0;

$start_time_recursive = microtime(true);
$factorial_recursive_result = factorial_recursive($num);
$end_time_recursive = microtime(true);
$duration_recursive = $end_time_recursive - $start_time_recursive;

$start_time_non_recursive = microtime(true);
$factorial_non_recursive_result = factorial_non_recursive($num);
$end_time_non_recursive = microtime(true);
$duration_non_recursive = $end_time_non_recursive - $start_time_non_recursive;

echo "Result of calculating factorial recursively for the number $num: $factorial_recursive_result<br>";
echo "Duration of recursive function: $duration_recursive seconds<br>";

echo "Result of calculating factorial non-recursively for the number $num: $factorial_non_recursive_result<br>";
echo "Duration of non-recursive function: $duration_non_recursive seconds<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial Calculator</title>
</head>
<body>
<form action="" method="GET">
    <label for="num">Enter a number:</label>
    <input type="number" id="num" name="num" required><br><br>
    <button type="submit">Calculate Factorial</button>
</form>
</body>
</html>
