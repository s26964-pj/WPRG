<?php
$owoce = array("jablko", "banan", "pomarancza");

foreach ($owoce as $owoc) {
    $dlugosc = strlen($owoc);
    $owocOdwrocony = '';
    for($i = $dlugosc - 1; $i >= 0; $i--){
        $owocOdwrocony .= $owoc[$i];
    }
    if($owoc[0] == 'p' or $owoc[0] == 'P'){
        echo ("Owoc: ".$owocOdwrocony . " zaczyna się na literę p\n");
    }
    else {
        echo ("Owoc: ".$owocOdwrocony . "\n");
    }
}
?>
