<?php
$a = 10;
$ciag[] = 0;

for ($i = 0; $i <= $a; $i++) {
    if ($i < 2) {
        $ciag[$i] = 1;
    } else {
        $ciag[$i] = $ciag[$i - 1] + $ciag[$i - 2];
    }
}
foreach ($ciag as $element) {
    if ($element % 2 != 0)
        echo($element . "\n");
}
?>
