<?php
$targetVisits = 5;

$cookieName = 'visit_count';

if (isset($_COOKIE[$cookieName])) {
    $visitCount = intval($_COOKIE[$cookieName]) + 1;
} else {
    $visitCount = 1;
}


setcookie($cookieName, $visitCount, time() + (86400 * 30), "/"); // 86400 = 1 dzień

if ($visitCount >= $targetVisits) {
    echo "Gratulacje! Odwiedziłeś tę stronę $targetVisits razy.";
} else {
    echo "To jest Twoja $visitCount wizyta na tej stronie.";
}
?>
