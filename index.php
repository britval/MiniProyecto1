<?php
include_once 'utils/Navigation.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Proyecto #2 - Ingeniería Web</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        /* ======== GENERAL ======== */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #f6f3ff, #f2edff);
            color: #2c2c2c;
            display: flex;
            flex-direction: column; /* vertical layout */
            justify-content: space-between;
        }

        /* ======== CONTENEDOR PRINCIPAL ======== */
        .container {
            display: flex;
            flex-direction: row;
            background-color: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.15);
            width: 85%;
            max-width: 1150px;
            min-height: 600px;
            margin: 50px auto; /* centrado horizontal */
        }

        /* ======== PANEL IZQUIERDO ======== */
        .info-section {
            background: linear-gradient(145deg, #e8e3ff, #f1edff);
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-section h1 {
            color: #5B2C6F;
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .info-section h2 {
            color: #6C3483;
            font-weight: 500;
            margin-top: 0;
        }

        .info-section p {
            font-size: 1rem;
            color: #444;
            margin-top: 25px;
            line-height: 1.6;
            max-width: 420px;
        }

        .btn-primary {
            background: #6C5CE7;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 500;
            width: fit-content;
            margin-top: 30px;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #7C6FF2;
            transform: translateY(-3px);
        }

        /* ======== PANEL DERECHO ======== */
        .menu-section {
            flex: 1.3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            width: 100%;
            max-width: 650px;
        }

        .menu-btn {
            background: #6C5CE7;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 18px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.25);
            transition: all 0.25s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .menu-btn:hover {
            background: #7C6FF2;
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(108, 92, 231, 0.35);
        }

        /* ======== FOOTER CENTRADO ======== */
        footer {
            text-align: center;
            font-size: 14px;
            color: #6C3483;
            padding: 20px 0;
            background-color: #f4efff;
            border-top: 1px solid #dcd2ff;
            margin-top: auto;
            width: 100%;
        }

        /* ======== RESPONSIVE ======== */
        @media (max-width: 950px) {
            .container {
                flex-direction: column;
                width: 90%;
                min-height: auto;
            }

            .info-section, .menu-section {
                padding: 40px 30px;
                text-align: center;
            }

            .info-section h1 {
                font-size: 1.7rem;
            }

            .info-section p {
                max-width: 100%;
                margin: auto;
            }

            .menu-grid {
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }
        }

        @media (max-width: 600px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Panel Izquierdo -->
        <div class="info-section">
            <h1>Mini Proyecto #2</h1>
            <h2>Ingeniería Web - PHP</h2>
            <p>
                Cada problema se abre en una nueva vista con su interfaz y resultados visuales.
            </p>
            <a href="https://www.utp.ac.pa" target="_blank" class="btn-primary">Visitar UTP</a>
        </div>

        <!-- Panel Derecho -->
        <div class="menu-section">
            <div class="menu-grid">
                <a href="problems/problema1.php" class="menu-btn">📊 Problema 1</a>
                <a href="problems/problema2.php" class="menu-btn">➕ Problema 2</a>
                <a href="problems/problema3.php" class="menu-btn">✖️ Problema 3</a>
                <a href="problems/problema4.php" class="menu-btn">🔢 Problema 4</a>
                <a href="problems/problema5.php" class="menu-btn">👶 Problema 5</a>
                <a href="problems/problema6.php" class="menu-btn">🏥 Problema 6</a>
                <a href="problems/problema7.php" class="menu-btn">🌸 Problema 7</a>
                <a href="problems/problema8.php" class="menu-btn">⚡ Problema 8</a>
                <a href="problems/problema9.php" class="menu-btn">💼 Problema 9</a>
                <a href="problems/problema10.php" class="menu-btn">🧮 Problema 10</a>
            </div>
        </div>
    </div>

    <footer>
        Universidad Tecnológica de Panamá – Ingeniería Web<br>
        Fecha de ejecución: 13/10/2025
    </footer>

</body>
</html>
