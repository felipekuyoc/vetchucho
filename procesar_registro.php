<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'veterinaria';
$username = 'root'; // Cambia si es necesario
$password = ''; // Cambia si es necesario

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Procesar registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $perfil = htmlspecialchars($_POST['perfil']);

    try {
        // Verificar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            header("Location: login_registro.php?registro=error&mensaje=Correo ya registrado");
            exit;
        }

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

        // Redirigir con éxito
        header("Location: login_registro.php?registro=exito");
        exit;
    } catch (PDOException $e) {
        header("Location: login_registro.php?registro=error&mensaje=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    header("Location: login_registro.php");
    exit;
}
