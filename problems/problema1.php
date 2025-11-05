<?php
include_once '../utils/Validation.php';
include_once '../utils/MathUtils.php';
include_once '../utils/Navigation.php';

$resultado = "";
$numeros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 1; $i <= 5; $i++) {
        $num = Validation::sanitizeInput($_POST["num$i"]);
        if (Validation::isNumeric($num)) {
            $numeros[] = floatval($num);
        }
    }

    if (count($numeros) === 5) {
        $media = MathUtils::mean($numeros);
        $desv = MathUtils::stdDev($numeros);
        $min = MathUtils::minValue($numeros);
        $max = MathUtils::maxValue($numeros);

        $resultado = "
        <h3>Resultados Estadísticos</h3>
        <ul>
            <li>Media: <b>" . number_format($media, 2) . "</b></li>
            <li>Desviación Estándar: <b>" . number_format($desv, 2) . "</b></li>
            <li>Valor Mínimo: <b>{$min}</b></li>
            <li>Valor Máximo: <b>{$max}</b></li>
        </ul>
        ";
    } else {
        $resultado = "<p style='color:red;'>Por favor, introduzca los 5 valores numéricos correctamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 1 - Media y Desviación Estándar</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Problema 1</h1>
        <h2>Cálculo de Media, Desviación Estándar, Mínimo y Máximo</h2>

        <form method="POST" action="">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <label for="num<?php echo $i; ?>">Número <?php echo $i; ?>:</label>
                <input type="number" step="any" name="num<?php echo $i; ?>" required><br><br>
            <?php endfor; ?>
            <button type="submit">Calcular</button>
        </form>

        <div style="margin-top:20px;">
        <div class="container">
            <?php echo $resultado; ?>
        </div>

    </div>
    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
