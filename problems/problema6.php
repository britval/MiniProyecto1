<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$gine = $trauma = $pedia = 0;
$resultado = "";
$presupuesto = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $presupuesto = Validation::sanitizeInput($_POST["presupuesto"]);

    if (Validation::isNumeric($presupuesto) && $presupuesto > 0) {
        $gine  = $presupuesto * 0.40;
        $trauma = $presupuesto * 0.35;
        $pedia  = $presupuesto * 0.25;

        $resultado = "
        <h3>Resultados del Presupuesto</h3>
        <ul style='list-style:none; padding-left:0;'>
            <li><b>Ginecología (40%)</b>: $". number_format($gine, 2) ."</li>
            <li><b>Traumatología (35%)</b>: $". number_format($trauma, 2) ."</li>
            <li><b>Pediatría (25%)</b>: $". number_format($pedia, 2) ."</li>
        </ul>";
    } else {
        $resultado = "<p style='color:red;'>Por favor, ingrese un valor numérico válido.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 6 - Presupuesto Hospitalario</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body{
            font-family: 'Poppins', system-ui, -apple-system, Arial, sans-serif;
        }
        /* Contenedor más pequeño y con posición relativa para centrar el texto */
        .chart-container {
            width: 320px;              /* tamaño compacto */
            aspect-ratio: 1 / 1;       /* mantiene cuadrado */
            position: relative;        /* clave para centrar .chart-info */
            margin: 24px auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            padding: 12px;
        }
        /* El canvas ocupa todo el contenedor */
        .chart-container canvas {
            width: 100% !important;
            height: 100% !important;
        }
        /* Centrado perfecto del texto interior con flex */
        .chart-info {
            position: absolute;
            inset: 0;                  /* top/right/bottom/left: 0 */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;   /* centrado vertical real */
            text-align: center;
            pointer-events: none;      /* no bloquea el hover del gráfico */
            color: #444;
            gap: 2px;
        }
        .chart-info .title {
            font-weight: 600;
            font-size: 14px;
        }
        .chart-info .total {
            font-size: 13px;
            opacity: 0.85;
        }

        form {
            background: #ffffff;
            padding: 18px 24px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            margin-bottom: 18px;
        }
        input[type="number"]{
            padding: 8px 10px;
            border: 1px solid #d8d8e0;
            border-radius: 8px;
            width: 220px;
        }
        button{
            background: #6a5acd;
            color: #fff;
            border: 0;
            padding: 9px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover{ background: #5a4acb; }

        .resultado{
            max-width: 520px;
            margin: 12px auto 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            padding: 16px 20px;
        }
    </style>
</head>
<body>
    <h1>Problema 6</h1>
    <h2>Distribución del presupuesto hospitalario</h2>

    <form method="POST" action="">
        <label for="presupuesto">Ingrese el presupuesto anual ($):</label><br><br>
        <input type="number" name="presupuesto" step="0.01" min="0" required>
        <button type="submit">Calcular</button>
    </form>

    <div class="resultado">
        <?php echo $resultado; ?>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && Validation::isNumeric($presupuesto) && $presupuesto > 0): ?>
        <div class="chart-container">
            <canvas id="grafico"></canvas>
            <div class="chart-info">
                <div class="title">Distribución</div>
                <div class="total">Total: $<?php echo number_format($presupuesto, 2); ?></div>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('grafico').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Ginecología 40%', 'Traumatología 35%', 'Pediatría 25%'],
                    datasets: [{
                        data: [<?php echo $gine; ?>, <?php echo $trauma; ?>, <?php echo $pedia; ?>],
                        backgroundColor: ['#7B68EE', '#F5B041', '#48C9B0'],
                        hoverOffset: 8,
                        borderWidth: 3,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // para respetar el aspect-ratio del contenedor
                    cutout: '68%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 14,
                                boxHeight: 14,
                                font: { family: 'Poppins', size: 12 },
                                color: '#333'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            padding: 10,
                            cornerRadius: 8,
                            titleFont: { weight: '600' },
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
