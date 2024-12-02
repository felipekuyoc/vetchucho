<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Información del usuario logueado
$nombre = $_SESSION['nombre'];
$perfil = $_SESSION['perfil'];


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Recepcionista - Veterinaria</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f6f8;
            color: #333;
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Estilo del encabezado */
        header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 3px solid #28a745;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 150px;
            height: auto;
        }

        h1 {
            font-size: 2.5em;
            color: #28a745;
            margin: 10px 0;
        }

        h2 {
            font-size: 1.3em;
            color: #555;
        }

        /* Navegación */
        nav {
            margin: 20px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: inline-block;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
            font-weight: bold;
        }

        nav a:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Estilo de pie de página */
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Sección del encabezado con el logo -->
        <header>
            <img src="veterinaria_logo.png" alt="Logo Veterinaria" class="logo">
            <h1>Bienvenida, <?php echo htmlspecialchars($nombre); ?></h1>
            <h2>Perfil: <?php echo htmlspecialchars($perfil); ?></h2>
        </header>

        <!-- Navegación principal -->
        <nav>
            <ul>
                <li><a href="citas.php">Gestionar Citas</a></li>
                <li><a href="clientes.php">Gestionar Clientes</a></li>
                <li><a href="reportes.php">Generar Reportes</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>

        <!-- Pie de página -->
        <footer>
            &copy; <?php echo date("Y"); ?> Veterinaria. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>



