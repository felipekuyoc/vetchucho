<?php
session_start();
$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Tu usuario de la base de datos
$password = ""; // Tu contraseña de la base de datos
$dbname = "veterinaria"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de las tablas
$tables = ['Cliente', 'Usuarios', 'Detalle_Venta', 'Mascota', 'Producto', 'Tratamiento'];
$data = [];

foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    $data[$table] = $result->fetch_all(MYSQLI_ASSOC);
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Webmaster</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega aquí tu archivo CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .table-container {
            margin: 20px 0;
            border-radius: 5px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .logout {
            display: block;
            text-align: center;
            margin: 20px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Panel de Control - Webmaster</h1>

    <?php foreach ($data as $table => $rows): ?>
        <div class="table-container">
            <h2><?php echo $table; ?></h2>
            <table>
                <thead>
                    <tr>
                        <?php if (!empty($rows)): ?>
                            <?php foreach (array_keys($rows[0]) as $column): ?>
                                <th><?php echo ucfirst($column); ?></th>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?php echo htmlspecialchars($cell); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

    <a class="logout" href="logout.php">Cerrar Sesión</a>

</body>
</html>



