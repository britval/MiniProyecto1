<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$resultado = "";
$categorias = [
    "Niño (0-12)" => 0,
    "Adolescente (13-17)" => 0,
    "Adulto (18-64)" => 0,
    "Adulto mayor (65+)" => 0
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edades = [];
    for ($i = 1; $i <= 5; $i++) {
        $edad = Validation::sanitizeInput($_POST["edad$i"]);
        if (Validation::isNumeric($edad) && $edad >= 0) {
            $edades[] = intval($edad);
        }
    }

    if (count($edades) === 5) {
        foreach ($edades as $edad) {
            if ($edad <= 12) $categorias["Niño (0-12)"]++;
            elseif ($edad <= 17) $categorias["Adolescente (13-17)"]++;
            elseif ($edad <= 64) $categorias["Adulto (18-64)"]++;
            else $categorias["Adulto mayor (65+)"]++;
        }

        $resultado = "<h3>Clasificación de las edades ingresadas</h3><ul>";
        foreach ($categorias as $cat => $count) {
            $resultado .= "<li>$cat: <b>$count</b></li>";
        }
        $resultado .= "</ul>";

        $labels = json_encode(array_keys($categorias));
        $data = json_encode(array_values($categorias));
    } else {
        $resultado = "<p style='color:red;'>Debe ingresar las 5 edades correctamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 5 - Clasificación por Edades</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #f7f6ff, #ece9ff);
            color: #2c2c2c;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }
        form {
            background: #ffffff;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            text-align: center;
        }
        input[type="number"] {
            width: 100px;
            padding: 8px;
            margin: 4px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #6a5acd;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #5845c4;
        }
        .resultado {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            width: 340px;
        }
        .chart-container {
            width: 260px;
            height: 260px;
            margin: 20px auto;
            background: #fff;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <h1>Problema 5</h1>
    <h2>Clasificación de personas según su edad</h2>

    <form method="POST" action="">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="edad<?php echo $i; ?>">Edad <?php echo $i; ?>:</label>
            <input type="number" name="edad<?php echo $i; ?>" min="0" required><br><br>
        <?php endfor; ?>
        <button type="submit">Clasificar</button>
    </form>

    <div class="resultado">
        <?php echo $resultado; ?>
    </div>

    <?php if (!empty($data)): ?>
        <div class="chart-container">
            <canvas id="grafico"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('grafico');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo $labels; ?>,
                    datasets: [{
                        label: 'Cantidad',
                        data: <?php echo $data; ?>,
                        backgroundColor: [
                            '#7B68EE', // violeta suave
                            '#48C9B0', // verde agua
                            '#F5B041', // dorado
                            '#EC7063'  // coral
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 13, family: 'Poppins' },
                                color: '#333'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            cornerRadius: 8,
                            padding: 10,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 }
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
