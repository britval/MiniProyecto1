<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = Validation::sanitizeInput($_POST["numero"]);

    if (Validation::isNumeric($numero) && $numero >= 1 && $numero <= 9) {
        $resultado = "<h3>Las 15 primeras potencias del número <b>{$numero}</b>:</h3><ul>";
        for ($i = 1; $i <= 15; $i++) {
            $resultado .= "<li>{$numero}<sup>{$i}</sup> = " . pow($numero, $i) . "</li>";
        }
        $resultado .= "</ul>";
    } else {
        $resultado = "<p style='color:red;'>Por favor, ingrese un número entre 1 y 9.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 9</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Problema 9</h1>
    <h2>Generar las 15 primeras potencias del número ingresado</h2>

    <form method="POST" action="">
        <label for="numero">Ingrese un número (1–9):</label>
        <input type="number" name="numero" min="1" max="9" required>
        <button type="submit">Calcular</button>
    </form>

    <div style="margin-top:20px;">
        <?php echo $resultado; ?>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && Validation::isNumeric($numero) && $numero >= 1 && $numero <= 9): ?>
        <canvas id="grafico" width="400" height="200"></canvas>
        <script>
            const valores = [];
            for (let i = 1; i <= 15; i++) {
                valores.push(Math.pow(<?php echo $numero; ?>, i));
            }
            const ctx = document.getElementById('grafico');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array.from({length: 15}, (_, i) => i + 1),
                    datasets: [{
                        label: 'Potencias de <?php echo $numero; ?>',
                        data: valores,
                        borderColor: '#6C3483',
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
    <?php endif; ?>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>