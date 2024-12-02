<?php
session_start();
$conn = new mysqli('localhost', 'auxiliar', 'contrasena123', 'veterinaria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los tratamientos
$sql = "SELECT T.id_tratamiento, T.descripcion, T.costo, T.id_consulta
        FROM tratamiento T
        ORDER BY T.id_tratamiento ASC";

// Ejecutar la consulta y verificar si hay errores
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error); // Mostrar el error específico
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Tratamientos</title>
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
        <h1>Tratamientos de Mascotas</h1>
        <table>
            <tr>
                <th>ID Tratamiento</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>ID Consulta</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_tratamiento']); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['costo']); ?></td>
                <td><?php echo htmlspecialchars($row['id_consulta']); ?></td>
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
