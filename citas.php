<?php
$conn = new mysqli('localhost', 'recepcionista', 'contrasena123', 'veterinaria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si se envió el formulario para agregar una cita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];
    $id_mascota = $_POST['id_mascota'];
    $id_veterinario = $_POST['id_veterinario'];
    
    $sql = "INSERT INTO Consulta (fecha, motivo, id_mascota, id_veterinario) VALUES ('$fecha', '$motivo', '$id_mascota', '$id_veterinario')";
    $conn->query($sql);
}

// Si se quiere eliminar una cita
if (isset($_GET['eliminar'])) {
    $id_consulta = $_GET['eliminar'];
    $sql = "DELETE FROM Consulta WHERE id_consulta = $id_consulta";
    $conn->query($sql);
}

// Consulta para obtener las citas
$sql = "SELECT C.id_consulta, C.fecha, CL.nombre AS cliente, M.nombre AS mascota, V.nombre AS veterinario
        FROM Consulta C
        JOIN Mascota M ON C.id_mascota = M.id_mascota
        JOIN Cliente CL ON M.id_cliente = CL.id_cliente
        JOIN Veterinario V ON C.id_veterinario = V.id_veterinario
        ORDER BY C.fecha ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Citas</title>
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
        input[type="datetime-local"],
        input[type="text"],
        input[type="number"] {
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
    <h1>Gestionar Citas</h1>
</header>

<table>
    <tr>
        <th>ID Cita</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Mascota</th>
        <th>Veterinario</th>
        <th>Acción</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id_consulta']); ?></td>
        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
        <td><?php echo htmlspecialchars($row['cliente']); ?></td>
        <td><?php echo htmlspecialchars($row['mascota']); ?></td>
        <td><?php echo htmlspecialchars($row['veterinario']); ?></td>
        <td><a class="delete-link" href="citas.php?eliminar=<?php echo $row['id_consulta']; ?>">Eliminar</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<h2>Agregar Cita</h2>
<form method="post">
    <label>Fecha:</label>
    <input type="datetime-local" name="fecha" required>
    <label>Motivo:</label>
    <input type="text" name="motivo" required>
    <label>Mascota ID:</label>
    <input type="number" name="id_mascota" required>
    <label>Veterinario ID:</label>
    <input type="number" name="id_veterinario" required>
    <button type="submit">Agregar Cita</button>
</form>

</body>
</html>

