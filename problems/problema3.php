<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$resultado = "";
$valores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = Validation::sanitizeInput($_POST["n"]);

    if (Validation::isNumeric($n) && $n > 0) {
        for ($i = 1; $i <= $n; $i++) {
            $valores[] = "4 × $i = " . (4 * $i);
        }

        $resultado = "<h3>Primeros $n múltiplos de 4:</h3><ul>";
        foreach ($valores as $v) {
            $resultado .= "<li>$v</li>";
        }
        $resultado .= "</ul>";

    } else {
        $resultado = "<p style='color:red;'>Ingrese un número válido mayor que 0.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 3 - Múltiplos de 4</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Problema 3</h1>
    <h2>Imprimir los N primeros múltiplos de 4</h2>

    <form method="POST" action="">
        <label for="n">Ingrese la cantidad de múltiplos:</label>
        <input type="number" name="n" min="1" required>
        <button type="submit">Mostrar</button>
    </form>

    <div style="margin-top:20px;">
        <?php echo $resultado; ?>
    </div>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
