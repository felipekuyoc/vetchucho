<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro Veterinaria</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .tab {
            padding: 10px;
            background-color: #f0f4f8;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .tab.active {
            background-color: white;
            border-bottom: none;
            font-weight: bold;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" data-target="login-form">Iniciar Sesión</div>
            <div class="tab" data-target="register-form">Registrarse</div>
        </div>

        <!-- Formulario de inicio de sesión -->
        <div id="login-form" class="form-container active">
            <h2>INICIO DE SESIÓN</h2>
            <form action="procesar_login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" required>
                
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>

        <!-- Formulario de registro -->
<div id="register-form" class="form-container">
    <h2>REGISTRO DE USUARIOS</h2>
    <?php if (isset($_GET['registro'])): ?>
        <p style="color: <?php echo $_GET['registro'] === 'exito' ? 'green' : 'red'; ?>">
            <?php echo htmlspecialchars($_GET['mensaje'] ?? ($_GET['registro'] === 'exito' ? 'Registro exitoso.' : 'Error en el registro.')); ?>
        </p>
    <?php endif; ?>
    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        
        <label for="perfil">Perfil:</label>
        <input type="text" name="perfil" id="perfil" required>
        
        <button type="submit">Registrarse</button>
    </form>
</div>


    <script>
        // Alternar entre formularios
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.form-container').forEach(form => form.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(tab.dataset.target).classList.add('active');
            });
        });
    </script>
</body>
</html>

--------