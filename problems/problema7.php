<?php
include_once '../utils/Validation.php';
include_once '../utils/MathUtils.php';
include_once '../utils/Navigation.php';

$resultado = "";
$notas = [];
$cantidad = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = isset($_POST["cantidad"]) ? Validation::sanitizeInput($_POST["cantidad"]) : 0;

    if (Validation::isNumeric($cantidad) && $cantidad > 0) {
        for ($i = 1; $i <= $cantidad; $i++) {
            $campo = "nota$i";
            if (isset($_POST[$campo])) { // Verifica si el campo existe
                $valor = Validation::sanitizeInput($_POST[$campo]);
                if (Validation::isNumeric($valor) && $valor >= 0 && $valor <= 100) {
                    $notas[] = floatval($valor);
                }
            }
        }

        if (count($notas) > 0) {
            $media = MathUtils::mean($notas);
            $desv = MathUtils::stdDev($notas);
            $min = MathUtils::minValue($notas);
            $max = MathUtils::maxValue($notas);

            $resultado = "
            <h3>Resultados Estadísticos</h3>
            <ul>
                <li>Promedio: <b>" . number_format($media, 2) . "</b></li>
                <li>Desviación Estándar: <b>" . number_format($desv, 2) . "</b></li>
                <li>Nota Mínima: <b>{$min}</b></li>
                <li>Nota Máxima: <b>{$max}</b></li>
            </ul>";

            $labels = json_encode(range(1, count($notas)));
            $data = json_encode($notas);
        } else {
            $resultado = "<p style='color:red;'>Debe ingresar al menos una nota válida.</p>";
        }
    } else {
        $resultado = "<p style='color:red;'>Ingrese una cantidad válida de notas.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 7</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Problema 7</h1>
    <h2>Calculadora de Promedio, Desviación Estándar, Nota Mínima y Máxima</h2>

    <!-- Formulario para indicar cantidad -->
    <form method="POST" action="">
        <label for="cantidad">Cantidad de notas a ingresar:</label>
        <input type="number" name="cantidad" min="1" max="50" required>
        <button type="submit">Generar Campos</button>
    </form>

    <!-- Formulario dinámico de notas -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($notas) && Validation::isNumeric($cantidad) && $cantidad > 0): ?>
        <form method="POST" action="" style="margin-top:20px;">
            <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
            <?php for ($i = 1; $i <= $cantidad; $i++): ?>
                <label for="nota<?php echo $i; ?>">Nota <?php echo $i; ?>:</label>
                <input type="number" name="nota<?php echo $i; ?>" step="0.01" min="0" max="100" required><br><br>
            <?php endfor; ?>
            <button type="submit">Calcular</button>
        </form>
    <?php endif; ?>

    <div style="margin-top:25px;">
        <?php echo $resultado; ?>
    </div>

    <!-- Gráfico -->
    <?php if (!empty($data)): ?>
        <div style="width:400px; margin:auto;">
            <canvas id="grafico"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('grafico');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo $labels; ?>,
                    datasets: [{
                        label: 'Notas Ingresadas',
                        data: <?php echo $data; ?>,
                        backgroundColor: '#7B68EE',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, max: 100 }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            cornerRadius: 8,
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 }
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
