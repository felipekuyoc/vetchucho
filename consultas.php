<?php
session_start();
$conn = new mysqli('localhost', 'auxiliar', 'contrasena123', 'veterinaria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener todas las consultas
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
    <title>Ver Consultas</title>
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
        h1 {
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
        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>

<header>
    <h1>Consultas Veterinarias</h1>
</header>

<table>
    <tr>
        <th>ID Consulta</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Mascota</th>
        <th>Veterinario</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_consulta']); ?></td>
            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            <td><?php echo htmlspecialchars($row['cliente']); ?></td>
            <td><?php echo htmlspecialchars($row['mascota']); ?></td>
            <td><?php echo htmlspecialchars($row['veterinario']); ?></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="no-data">No hay consultas registradas.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
