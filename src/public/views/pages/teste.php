<?php

require '../../../../vendor/autoload.php';

use src\models\Data;

$teste = new Data();

$teste->getData();

foreach ($teste->getData() as $key => $value) {
    echo("TS - " . $value['tempodeservico']);
    echo("\nTC - " . $value['tempodechegada']);
    echo("<br>");
}

