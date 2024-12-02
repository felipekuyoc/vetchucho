<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'veterinaria';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Procesamiento del formulario
$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $perfil = htmlspecialchars($_POST['perfil']);

    try {
        // Validar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $mensaje = "El correo electrónico ya está registrado.";
        } else {
            // Encriptar contraseña
            $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);

            // Insertar datos en la base de datos
            $sql = "INSERT INTO usuarios (nombre, email, contrasena, perfil) VALUES (:nombre, :email, :contrasena, :perfil)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':contrasena' => $hashedPassword,
                ':perfil' => $perfil
            ]);

            $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
        }
    } catch (PDOException $e) {
        $mensaje = "Error al registrar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h1>Registro de Usuarios</h1>
    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <label for="perfil">Perfil:</label>
        <input type="text" name="perfil" id="perfil" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
