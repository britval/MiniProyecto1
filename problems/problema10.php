<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$resultado = "";

// Productos (frutas) y sus precios fijos
$frutas = ["Manzana", "Banano", "Mango", "Piña", "Sandía"];
$precios = [1.25, 0.75, 1.50, 1.80, 2.00]; // Precio unitario en USD

$ventas = []; // matriz [producto][vendedor]

// Inicializar matriz 5x4 con ceros
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $ventas[$i][$j] = 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar cantidades vendidas
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $campo = "p" . ($i + 1) . "_v" . ($j + 1);
            $valor = Validation::sanitizeInput($_POST[$campo]);
            if (Validation::isNumeric($valor) && $valor >= 0) {
                $ventas[$i][$j] = floatval($valor) * $precios[$i]; // cantidad × precio
            }
        }
    }

    // Totales por producto y vendedor
    $totalesProductos = [];
    $totalesVendedores = array_fill(0, 4, 0);

    for ($i = 0; $i < 5; $i++) {
        $totalesProductos[$i] = array_sum($ventas[$i]);
        for ($j = 0; $j < 4; $j++) {
            $totalesVendedores[$j] += $ventas[$i][$j];
        }
    }

    // Mostrar resultados
    $resultado = "<h3>Tabla de Ventas Mensuales (USD)</h3>
    <table border='1' cellpadding='8' style='border-collapse:collapse; text-align:center; margin-top:10px;'>
        <tr style='background:#e8e8ff;'>
            <th>Fruta</th>
            <th>Precio Unitario</th>
            <th>Vendedor 1</th>
            <th>Vendedor 2</th>
            <th>Vendedor 3</th>
            <th>Vendedor 4</th>
            <th>Total Fruta</th>
        </tr>";

    for ($i = 0; $i < 5; $i++) {
        $resultado .= "<tr><td>{$frutas[$i]}</td>
        <td>$" . number_format($precios[$i], 2) . "</td>";
        for ($j = 0; $j < 4; $j++) {
            $resultado .= "<td>$" . number_format($ventas[$i][$j], 2) . "</td>";
        }
        $resultado .= "<td><b>$" . number_format($totalesProductos[$i], 2) . "</b></td></tr>";
    }

    $resultado .= "<tr style='font-weight:bold; background:#f0f0f0;'>
        <td colspan='2'>Total por Vendedor</td>";
    for ($j = 0; $j < 4; $j++) {
        $resultado .= "<td>$" . number_format($totalesVendedores[$j], 2) . "</td>";
    }
    $resultado .= "<td>-</td></tr></table>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 10 - Ventas de Frutas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Problema 10</h1>
    <h2>Ventas de Frutas por Vendedor</h2>

    <form method="POST" action="">
        <p>Ingrese la <b>cantidad vendida</b> de cada fruta por cada vendedor:</p>
        <table border="1" cellpadding="8" style="border-collapse:collapse; text-align:center;">
            <tr style="background:#f9f9f9;">
                <th>Fruta</th>
                <th>Precio (USD)</th>
                <th>Vendedor 1</th>
                <th>Vendedor 2</th>
                <th>Vendedor 3</th>
                <th>Vendedor 4</th>
            </tr>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td><?php echo $frutas[$i]; ?></td>
                    <td>$<?php echo number_format($precios[$i], 2); ?></td>
                    <?php for ($j = 1; $j <= 4; $j++): ?>
                        <td><input type="number" name="p<?php echo $i + 1; ?>_v<?php echo $j; ?>" step="1" min="0" value="0"></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <br>
        <button type="submit">Calcular Totales</button>
    </form>

    <div style="margin-top:20px;">
        <?php echo $resultado; ?>
    </div>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
