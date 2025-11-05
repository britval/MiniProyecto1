<?php
include_once '../utils/MathUtils.php';
include_once '../utils/Navigation.php';

$sumaPares = 0;
$sumaImpares = 0;

for ($i = 1; $i <= 200; $i++) {
    if ($i % 2 == 0) {
        $sumaPares += $i;
    } else {
        $sumaImpares += $i;
    }
}

$total = $sumaPares + $sumaImpares;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 4 - Suma Pares e Impares</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Problema 4</h1>
    <h2>Suma de Números Pares e Impares (1–200)</h2>

    <p><b>Suma de Pares:</b> <?php echo number_format($sumaPares); ?></p>
    <p><b>Suma de Impares:</b> <?php echo number_format($sumaImpares); ?></p>
    <p><b>Total:</b> <?php echo number_format($total); ?></p>

    <canvas id="grafico" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('grafico');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pares', 'Impares'],
                datasets: [{
                    label: 'Suma',
                    data: [<?php echo $sumaPares; ?>, <?php echo $sumaImpares; ?>],
                    backgroundColor: ['#4B0082', '#FF5733']
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
