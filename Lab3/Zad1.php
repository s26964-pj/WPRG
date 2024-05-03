<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date of Birth Form</title>
</head>
<body>
<?php
if(isset($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];

    function day_of_week($date) {
        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        return $days[date('N', strtotime($date)) - 1];
    }

    function calculate_age($date) {
        $today = new DateTime();
        $birth_date = new DateTime($date);
        $age = $today->diff($birth_date)->y;
        return $age;
    }

    function days_until_next_birthday($date) {
        $today = new DateTime();
        $next_birthday = new DateTime(date('Y') . '-' . date('m-d', strtotime($date)));
        if ($today > $next_birthday) {
            $next_birthday->modify('+1 year');
        }
        $interval = $today->diff($next_birthday);
        return $interval->days;
    }

    echo "<p>The user was born on: " . day_of_week($birthdate) . "</p>";
    echo "<p>The user is " . calculate_age($birthdate) . " year(s) old</p>";
    echo "<p>Number of days until the next upcoming birthday: " . days_until_next_birthday($birthdate) . "</p>";
} else {
    echo '
        <form action="" method="GET">
            <label for="birthdate">Select your date of birth:</label>
            <input type="date" id="birthdate" name="birthdate">
            <button type="submit">Submit</button>
        </form>';
}
?>
</body>
</html>
