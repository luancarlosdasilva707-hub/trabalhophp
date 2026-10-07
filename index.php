<?php
session_start();
if (!isset($_SESSION["medidas"])) {
    $_SESSION["medidas"] = [];
}
function guardarMedidas($a, $c) {
    $_SESSION["medidas"][] = [
        "altura" => $a,
        "comprimento" => $c,
        "area" => $a * $c
    ];
}
function mostrarMedidas() {
    if (empty($_SESSION["medidas"])) {
        echo "<h2>Nenhuma medida foi guardada.</h2>";
        return;
    }
    echo "<h2>Medidas guardadas:</h2>";
    foreach ($_SESSION["medidas"] as $i => $m) {
        echo "<p>#" . ($i + 1) . " - Altura: {$m['altura']} | Comprimento: {$m['comprimento']} | Área: {$m['area']}</p>";
    }
}
$acao = $_GET["acao"] ?? "";
if ($acao == "guardar") {
    $a = $_GET["faltura"] ?? "";
    $c = $_GET["fcomprimento"] ?? "";
    if (is_numeric($a) && is_numeric($c)) {
        guardarMedidas($a, $c);
    } else {
        echo "<h2>Preencha altura e comprimento com números.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova de PHP</title>
</head>
<body>
    <h1>Abaixo informe medidas para que possamos calcular a área do seu quadrado ou retângulo</h1>
    <form action="#" method="get">
        <label for="faltura">Altura: </label>
        <input type="number" id="faltura" name="faltura" step="0.01">
        <br><br>
        <label for="fcomprimento">Comprimento: </label>
        <input type="number" id="fcomprimento" name="fcomprimento" step="0.01">
        <br><br>
        <button type="submit" name="acao" value="calcular">Calcular</button>
        <br><br>
        <button type="submit" name="acao" value="guardar">Guardar Medidas</button>
        <br><br>
        <button type="submit" name="acao" value="mostrar">Mostrar Medidas</button>
    </form>

    <?php
if (isset($_GET["faltura"]) && isset($_GET["fcomprimento"])) {
    $altura = $_GET["faltura"];
    $comprimento = $_GET["fcomprimento"];

    if (is_numeric($altura) && is_numeric($comprimento)) {
        $area = $altura * $comprimento;

        if ($altura == $comprimento) {
            echo "<h2>O quadrado possui área de: $area</h2>";
        } else if ($altura > $comprimento) {
            echo "<h2>O seu retângulo vertical possui área de: $area</h2>";
        } else {
            echo "<h2>O seu retângulo horizontal possui área de: $area</h2>";
        }
    } else {
        echo "<h2>Preencha altura e comprimento com números.</h2>";
    }
} 
if ($acao == "mostrar") {
    mostrarMedidas();
}
?>

</body>
</html>