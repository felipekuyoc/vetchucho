<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'peluquero', 'contrasena123', 'veterinaria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Reporte de mascotas
$sqlMascotas = "SELECT id_mascota, nombre, tipo, raza, edad FROM Mascota ORDER BY nombre ASC";
$resultMascotas = $conn->query($sqlMascotas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Mascotas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f9f9f9;
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
            color: #007bff;
            margin-bottom: 20px;
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
            background-color: #007bff;
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
        <h1>Reporte de Mascotas</h1>
        <table>
            <tr>
                <th>ID Mascota</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Raza</th>
                <th>Edad</th>
            </tr>
            <?php while($row = $resultMascotas->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_mascota']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                <td><?php echo htmlspecialchars($row['raza']); ?></td>
                <td><?php echo htmlspecialchars($row['edad']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Pie de página -->
    <footer>
        &copy; <?php echo date("Y"); ?> Veterinaria. Todos los derechos reservados.
    </footer>

    <?php $conn->close(); ?>
</body>
</html>
