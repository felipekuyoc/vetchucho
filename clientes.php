<?php
$conn = new mysqli('localhost', 'recepcionista', 'contrasena123', 'veterinaria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si se envió el formulario para agregar un cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO Cliente (nombre, apellido, telefono, email, direccion) VALUES ('$nombre', '$apellido', '$telefono', '$email', '$direccion')";
    $conn->query($sql);
}

// Si se quiere eliminar un cliente
if (isset($_GET['eliminar'])) {
    $id_cliente = $_GET['eliminar'];
    $sql = "DELETE FROM Cliente WHERE id_cliente = $id_cliente";
    $conn->query($sql);
}

// Consulta para obtener los clientes
$sql = "SELECT * FROM Cliente";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        header {
            background: #007BFF;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        h1, h2 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007BFF;
            color: #fff;
        }
        tr:hover {
            background: #f1f1f1;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #218838;
        }
        .delete-link {
            color: #dc3545;
            text-decoration: none;
        }
        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>Gestionar Clientes</h1>
</header>

<table>
    <tr>
        <th>ID Cliente</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Acción</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
        <td><a class="delete-link" href="clientes.php?eliminar=<?php echo $row['id_cliente']; ?>">Eliminar</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<h2>Agregar Cliente</h2>
<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Apellido:</label>
    <input type="text" name="apellido" required>
    <label>Teléfono:</label>
    <input type="text" name="telefono" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Dirección:</label>
    <input type="text" name="direccion" required>
    <button type="submit">Agregar Cliente</button>
</form>

</body>
</html>
