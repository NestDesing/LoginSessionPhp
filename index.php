

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - User System</title>
    <link rel="stylesheet" href="libraries/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
<?php
session_start(); // Inicia la sesión

// Incluir la configuración de la base de datos si es necesario
require 'config.php';

if (isset($_SESSION['username'])) {
    // Si la sesión está activa, mostrar el nuevo 
	require 'header.php'; 
    ?>


        <div class="container center-align"  style="margin-top: 100px;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel ligula nec urna scelerisque varius. Sed sollicitudin vehicula risus, ac varius nulla vestibulum at. Aenean gravida metus vitae diam cursus, non vehicula mi consequat.</p>
        </div>
 
    <?php
} else {
    // Si no hay sesión iniciada, mostrar el contenido actual
    ?>
        <div class="container center-align" style="margin-top: 200px;">
		    <img src="images/logo.png" alt="Logo" class="responsive-img" style="max-width: 150px;">
            <h1>Bienvenido a nuestro Website</h1>
            <p>Disfruta de nuestros servicios...</p>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Registrar</a>
        </div>

 
    <?php
}
?>
    <script src="libraries/materialize/js/materialize.min.js"></script>
	
	  <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown);
        });
    </script>
   </body>
   </html>
