<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no ha iniciado sesión
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Auxiliar Veterinario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        header {
            background: #007BFF;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }
        h1 {
            margin: 0;
        }
        h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: #218838;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
        <p>Perfil: <?php echo htmlspecialchars($_SESSION['perfil']); ?></p>
    </header>
    
    <main>
        <h2>Opciones</h2>
        <ul>
            <li><a href="consultas.php">Ver Consultas</a></li>
            <li><a href="tratamiento.php">Ver Tratamientos</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

