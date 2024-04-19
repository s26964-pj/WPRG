<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>

<h2>Calculator</h2>

<form method="post">
    <label for="num1">Number 1:</label>
    <input type="number" id="num1" name="num1" required><br><br>

    <label for="num2">Number 2:</label>
    <input type="number" id="num2" name="num2" required><br><br>

    <label for="operation">Operation:</label>
    <select id="operation" name="operation">
        <option value="add">Addition</option>
        <option value="subtract">Subtraction</option>
        <option value="multiply">Multiplication</option>
        <option value="divide">Division</option>
    </select><br><br>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if(isset($_POST['calculate'])) {
    $number1 = $_POST['num1'];
    $number2 = $_POST['num2'];
    $operation = $_POST['operation'];

    switch($operation) {
        case 'add':
            $result = $number1 + $number2;
            break;
        case 'subtract':
            $result = $number1 - $number2;
            break;
        case 'multiply':
            $result = $number1 * $number2;
            break;
        case 'divide':
            if($number2 == 0) {
                echo "Cannot divide by zero!";
            } else {
                $result = $number1 / $number2;
            }
            break;
        default:
            echo "Unknown operation!";
    }

    if(isset($result)) {
        echo "Result: $result";
    }
}
?>

</body>
</html>
