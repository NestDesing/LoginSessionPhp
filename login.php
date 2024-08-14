<?php

session_start(); // Iniciar la sesión

// Conectar a la base de datos
require 'config.php'; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User System</title>
    <link rel="stylesheet" href="libraries/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php
require 'header.php'; // Incluir el archivo del encabezado
?>
    <div class="container center-align" style="margin-top: 100px;">
        <img src="images/logo.png" alt="Logo" class="responsive-img" style="max-width: 150px;">
        <h4>Login</h4>
        <form action="login.php" method="POST">
            <div class="input-field">
                <input type="text" id="username" name="username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <script src="libraries/materialize/js/materialize.min.js"></script>
	
	<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Obtener el nombre de usuario del formulario
    $password = md5($_POST['password']); // Encriptar la contraseña en MD5

    // Consultar la base de datos para verificar las credenciales del usuario
    $query = "SELECT * FROM custommers WHERE email = '$username' AND pass = '$password'";
    $result = mysqli_query($conn, $query); // Ejecutar la consulta

    if (mysqli_num_rows($result) == 1) { // Si existe un registro que coincide
        $_SESSION['username'] = $username; // Guardar el nombre de usuario en la sesión
        $_SESSION['login_success'] = 'Acceso correcto'; // Guardar mensaje de éxito en la sesión
			 header('Location: profile.php'); // Redirigir 
             exit(); // Detener la ejecución del script después de la redirección
    } else {
        $_SESSION['login_error'] = 'Datos inválidos'; // Guardar mensaje de error en la sesión
        header('Location: login.php'); // Redirigir de vuelta al formulario de login
        exit(); // Detener la ejecución del script después de la redirección
    }
}
?>
	
    <script>
        // Inicializar componentes de Materialize
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['login_error'])): ?>
                // Mostrar mensaje de error con M.toast()
                M.toast({html: '<?php echo $_SESSION['login_error']; ?>', displayLength: 3000});
                <?php unset($_SESSION['login_error']); // Limpiar el mensaje de error ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['login_success'])): ?>
			   M.toast({html: '<?php echo $_SESSION['login_success']; ?>', displayLength: 3000});
                <?php unset($_SESSION['login_success']); // Limpiar el mensaje de success?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
