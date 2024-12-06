<?php

require '../../../../vendor/autoload.php';
use src\models\CustomerServiceSimulator;

$numberOfAttendants = $_GET['numberOfAttendants'];

$simulator = new CustomerServiceSimulator($numberOfAttendants);
$resultSimulation = $simulator->runSimulation();

$numberOfAttendants == 1 ? $numberOfAttendants = $numberOfAttendants . ' atendente' : $numberOfAttendants = $numberOfAttendants . ' atendentes';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script src="../../assets/js/Simulation.js" defer></script>
</head>
<body>
    <div id="mainDiv">
        <section id="titleSection">
            <h1>Resultado da simulação com <?= $numberOfAttendants ?> </h1>
        </section>
        <section id="resultsSection">
            <h1>Tempo total de simulação: <span><?= $resultSimulation['simulationTime'] ?> minutos</span> </h1>
            <h1>Média de tempo oscioso: <span><?= $resultSimulation['averageidleTime'] ?> minutos</span> </h1>
            <h1>Média de tempo de espera: <span><?= $resultSimulation['averageWaitTime']?> minutos</span> </h1>
        </section>
        <section class="buttonSection">
            <button onclick="backToHomePage()">
                Voltar para o inicio
            </button>
        </section>
    </div>
</body>
</html>