<?php

require '../../../../vendor/autoload.php';

use src\models\Data;

$teste = new Data();

$teste->getData();

foreach ($teste->getData() as $key => $value) {
    echo("TS - " . $value['serviceTime']);
    echo("\nTC - " . $value['arrivalTime']);
    echo("<br>");
}

