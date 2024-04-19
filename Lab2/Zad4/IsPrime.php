<!DOCTYPE html>
<html>
<head>
    <title>Is Prime</title>
</head>
<body>

<h2>Is Prime</h2>

<form method="post">
    <label for="number">Number:</label>
    <input type="number" id="number" name="number" required><br><br>

    <input type="submit" name="check" value="Check">
</form>

<?php
function isPrime($number) {
    if ($number <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}

if(isset($_POST['check'])) {
    $number = $_POST['number'];

    if(!is_numeric($number) || $number <= 0 || !is_int($number + 0)) {
        echo "The entered value is not a positive integer.";
    } else {
        if(isPrime($number)) {
            echo "$number is a prime number.";
        } else {
            echo "$number is not a prime number.";
        }
    }
}
?>

</body>
</html>
