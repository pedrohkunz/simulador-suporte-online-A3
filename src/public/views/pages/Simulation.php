<?php

require '../../../../vendor/autoload.php';
use src\models\CustomerServiceSimulator;
    
$simulator = new CustomerServiceSimulator($_GET['numberOfAttendants']);
$resultSimulation = $simulator->runSimulation();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tempo total de simulação: <?= $resultSimulation['simulationTime'] ?> minutos</h1>
    <h1>Média de tempo oscioso: <?= $resultSimulation['averageidleTime'] ?> minutos</h1>
    <h1>Média de tempo de espera: <?= $resultSimulation['averageWaitTime'] ?> minutos</h1>
</body>
</html>