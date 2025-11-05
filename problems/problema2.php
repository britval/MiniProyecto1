<?php
include_once '../utils/Navigation.php';

$suma = null;
$formula = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = intval($_POST["numero"]);

    if ($n > 0) {
        // Cálculo con ciclo for
        $suma = 0;
        for ($i = 1; $i <= $n; $i++) {
            $suma += $i;
        }

        // Cálculo con fórmula matemática
        $formula = ($n * ($n + 1)) / 2;
    } else {
        $error = "Por favor ingrese un número mayor que 0.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 2 - Suma de números hasta N</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f6ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 40px;
        }
        form {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        input[type="number"] {
            padding: 8px;
            width: 150px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            background-color: #6a5acd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #5845c4;
        }
        .resultado {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Problema 2</h1>
    <h2>Calcular la suma de los números del 1 hasta N</h2>

    <form method="post" action="">
        <label for="numero">Ingrese un número N:</label><br><br>
        <input type="number" name="numero" id="numero" min="1" required>
        <input type="submit" value="Calcular">
    </form>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($suma !== null && $formula !== null): ?>
        <div class="resultado">
            <p>Usando ciclo <code>for</code>:</p>
            <h3><?php echo number_format($suma); ?></h3>

            <p>Usando fórmula matemática <code>n(n+1)/2</code>:</p>
            <h3><?php echo number_format($formula); ?></h3>

            <?php if ($suma === $formula): ?>
                <p><b>Ambos métodos arrojan el mismo resultado.</b></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
