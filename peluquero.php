<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['perfil'] !== 'Peluquero Canino') {
    header("Location: login.php"); // Redirigir al login si no ha iniciado sesión
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Peluquero Canino</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d0e4f0); /* Fondo degradado suave */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Contenedor principal */
        .container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15); /* Sombra sutil */
            padding: 40px;
            text-align: center;
            width: 320px;
            max-width: 90%;
        }

        h1 {
            font-size: 1.6em;
            margin: 10px 0;
            color: #333;
        }

        .perfil {
            color: #888;
            font-size: 0.9em;
            margin-top: 5px;
            font-style: italic;
        }

        /* Título de Opciones */
        h2 {
            font-size: 1.3em;
            color: #4a90e2;
            margin: 25px 0 15px;
            font-weight: 400;
        }

        /* Opciones de Navegación */
        .options {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .options li {
            margin: 10px 0;
        }

        .options a {
            text-decoration: none;
            color: #4a90e2;
            background-color: #e9f4ff;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-block;
            width: 100%;
            transition: all 0.3s;
        }

        .options a:hover {
            background-color: #d0e7ff;
            transform: translateY(-2px); /* Efecto de elevación */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Bienvenida al Usuario -->
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
        <p class="perfil">Perfil: <?php echo htmlspecialchars($_SESSION['perfil']); ?></p>

        <!-- Opciones de Navegación -->
        <h2>Opciones</h2>
        <ul class="options">
            <li><a href="citas_peluqueria.php">Ver Citas de Peluquería</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</body>
</html>
