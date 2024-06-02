<?php
$targetVisits = 5;

$cookieName = 'visit_count';

$sessionCookieName = 'visited_session';

if (isset($_COOKIE[$cookieName])) {
    $visitCount = intval($_COOKIE[$cookieName]);
} else {
    $visitCount = 0;
}

if (!isset($_COOKIE[$sessionCookieName])) {
    $visitCount++;
    setcookie($cookieName, $visitCount, time() + (86400 * 30), "/"); // 86400 = 1 dzień
    setcookie($sessionCookieName, 'true', 0, "/");
}

if ($visitCount >= $targetVisits) {
    echo "Gratulacje! Odwiedziłeś tę stronę $targetVisits razy.";
} else {
    echo "To jest Twoja $visitCount wizyta na tej stronie.";
}
?>
