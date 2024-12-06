<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>Suporte Online</title>
</head>
<script src="../../assets/js/HomePage.js" defer></script>
<body>
    <section id="titleSection">
        <h1>Bem-vindo(a) ao simulador de suporte online</h1>
    </section>
    <section id="settingsSection">
        <article>
            <h2>Quantidade de atendentes</h2>
            <div id="numberOfAttendantsButton">
                <button onclick="decrement()">-</button>
                <input type="number" id="numberOfAttendantsValue" value="1" min="1" max="100" onchange="verifyValue()">
                <button onclick="increment()">+</button>
            </div>
        </article>
    </section>
    <section id="startButtonSection">
        <button onclick="startSimulation()">
            Iniciar simulação de atendimento
        </button>
    </section>
</body>
</html>