<?php

require '../../../../vendor/autoload.php';

use src\models\CustomerTickets;

$teste = new CustomerTickets();

$teste->getCustomerTickets();

foreach ($teste->getCustomerTickets() as $key => $value) {
    echo("TS - " . $value['serviceTime']);
    echo("\nTC - " . $value['arrivalTime']);
    echo("<br>");
}

