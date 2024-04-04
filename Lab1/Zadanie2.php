<?php
$a = 25;
$b = 40;

for ($i = $a; $i <= $b; $i++) {
    $czyPierwsza = true;

    if ($i < 2) {
        $czyPierwsza = false;
    } else {
        for ($x = 2; $x * $x <= $i; $x++) {
            if ($i % $x == 0) {
                $czyPierwsza = false;
                break;
            }
        }
    }

    if ($czyPierwsza) {
        echo $i . "\n";
    }
}
?>
