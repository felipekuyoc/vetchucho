<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si tiene el perfil de Entrenador Canino
if (!isset($_SESSION['id_usuario']) || $_SESSION['perfil'] !== 'Entrenador Canino') {
    header("Location: login.php"); // Redirigir al login si no ha iniciado sesión o si el perfil no es correcto
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Entrenador Canino</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de tener el archivo CSS -->
</head>
<body>
    <div class="container">
        <img src="logo_veterinaria.png" alt="Logo Veterinaria" class="logo">
        
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h1>
        <img src="entrenador_imagen.jpg" alt="Imagen del Entrenador" class="entrenador-img">
        
        <p class="perfil">Perfil: <?php echo $_SESSION['perfil']; ?></p>
        
        <h2>Opciones</h2>
        <ul>
            <li><a href="entrenamiento.php">Ver Programas de Entrenamiento</a></li>
            <li><a href="clientes.php">Ver Clientes</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</body>
</html>