<?php
$conn = new mysqli('localhost', 'recepcionista', 'contrasena123', 'veterinaria');


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Reporte de todas las citas
$sqlCitas = "SELECT C.id_consulta, C.fecha, CL.nombre AS cliente, M.nombre AS mascota, V.nombre AS veterinario
            FROM Consulta C
            JOIN Mascota M ON C.id_mascota = M.id_mascota
            JOIN Cliente CL ON M.id_cliente = CL.id_cliente
            JOIN Veterinario V ON C.id_veterinario = V.id_veterinario
            ORDER BY C.fecha ASC";
$resultCitas = $conn->query($sqlCitas);

// Reporte de todos los clientes
$sqlClientes = "SELECT * FROM Cliente";
$resultClientes = $conn->query($sqlClientes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reportes</title>
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

        /* Estilo de encabezado */
        h1 {
            text-align: center;
            color: #28a745;
            margin-bottom: 20px;
        }

        h2 {
            color: #555;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 5px;
        }

        /* Estilo de tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
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
        <h1>Generar Reportes</h1>

        <h2>Reporte de Citas</h2>
        <table>
            <tr>
                <th>ID Cita</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Mascota</th>
                <th>Veterinario</th>
            </tr>
            <?php while($row = $resultCitas->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_consulta']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                <td><?php echo htmlspecialchars($row['mascota']); ?></td>
                <td><?php echo htmlspecialchars($row['veterinario']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Reporte de Clientes</h2>
        <table>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
            </tr>
            <?php while($row = $resultClientes->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['direccion']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Pie de página -->
    <footer>
        &copy; <?php echo date("Y"); ?> Veterinaria. Todos los derechos reservados.
    </footer>
</body>
</html>
