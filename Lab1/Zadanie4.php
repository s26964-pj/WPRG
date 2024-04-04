<?php
$tekst = "Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel lorem id ante tincidunt varius. Nulla id iaculis sapien, non congue nisl. Nulla placerat dolor ac rhoncus rhoncus. Vestibulum euismod enim ex, a malesuada metus vehicula sit amet. Curabitur nec mollis ligula. Quisque quam odio, feugiat non felis vel, tincidunt maximus ante. Quisque tincidunt velit nunc, ac finibus nibh porta nec. Cras maximus purus id lorem eleifend fermentum.";
$slowa = explode(" ", $tekst);

//Usuwanie interpunkcji
for ($i = 0; $i < count($slowa); $i++) {
    $ostatniZnak = substr($slowa[$i], -1);

    if ($ostatniZnak == "." || $ostatniZnak == ",") {

        for ($j = $i; $j < count($slowa) - 1; $j++) {
            $slowa[$j] = $slowa[$j + 1];
        }

        array_pop($slowa);
        $i--;
    }
}

//Tablica associacyjna -> parzyste - index / nieparzyste - klucz
$associacyjnaTablica = [];
for ($i = 0; $i < count($slowa); $i += 2) {
    $associacyjnaTablica[$slowa[$i]] = isset($slowa[$i + 1]) ? $slowa[$i + 1] : "";
}

//Wypisanie tablicy
foreach ($associacyjnaTablica as $klucz => $wartosc) {
    echo $klucz . " - " . $wartosc . "\n";
}


