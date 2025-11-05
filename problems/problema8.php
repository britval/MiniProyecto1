<?php
include_once '../utils/Validation.php';
include_once '../utils/Navigation.php';

$fecha = "";
$estacion = "";
$imagen = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = Validation::sanitizeInput($_POST["fecha"]);

    if (!empty($fecha)) {
        $mes = date("m", strtotime($fecha));
        $dia = date("d", strtotime($fecha));

        // Estaciones del año
        if (($mes == 12 && $dia >= 21) || ($mes <= 3 && $dia <= 20)) {
            $estacion = "Verano";
            $imagen = "../assets/img/verano.jpg";
        } elseif (($mes == 3 && $dia >= 21) || ($mes <= 6 && $dia <= 21)) {
            $estacion = "Otoño";
            $imagen = "../assets/img/otono.jpg";
        } elseif (($mes == 6 && $dia >= 22) || ($mes <= 9 && $dia <= 22)) {
            $estacion = "Invierno";
            $imagen = "../assets/img/invierno.jpg";
        } else {
            $estacion = "Primavera";
            $imagen = "../assets/img/primavera.jpg";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 8</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        img { border-radius: 10px; width: 400px; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Problema 8</h1>
    <h2>¿Qué estación es?</h2>

    <form method="POST" action="">
        <label>Seleccione una fecha:</label><br><br>
        <input type="date" name="fecha" required>
        <button type="submit">Mostrar</button>
    </form>

    <?php if (!empty($estacion)): ?>
        <div style="margin-top:20px;">
            <h3>Fecha ingresada: <?php echo date("d-m", strtotime($fecha)); ?></h3>
            <h3>La estación es: <span style="color:green;"><?php echo $estacion; ?></span></h3>
            <img src="<?php echo $imagen; ?>" alt="<?php echo $estacion; ?>">
        </div>
    <?php endif; ?>

    <?php Navigation::backToMenu(); ?>
    <?php include_once '../footer.php'; ?>
</body>
</html>
