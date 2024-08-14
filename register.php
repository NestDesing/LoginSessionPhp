<?php
require 'config.php';

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $password = md5($_POST['password']); // Encriptar la contraseña
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $fecha_registro = date('Y-m-d H:i:s');

    $query = "INSERT INTO custommers (dni, pass, nombre, apellido, direccion, telefono, email, ciudad, pais, fecha_registro) 
              VALUES ('$dni', '$password', '$nombre', '$apellido', '$direccion', '$telefono', '$email', '$ciudad', '$pais', '$fecha_registro')";

    if (mysqli_query($conn, $query)) {
			 echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    M.toast({html: 'Registro exitoso', displayLength: 2000});
                });
              </script>"; // Mensaje de exito 
    } else {
	    echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    M.toast({html: 'Error: No se pudo realizar el registro', displayLength: 2000});
                });
              </script>";// Mensaje de erorr
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - User System</title>
    <link rel="stylesheet" href="libraries/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

<body>
<?php
session_start(); // Iniciar la sesión si no está ya iniciada
require 'header.php'; 
?>
    <div class="container center-align" style="margin-top: 50px; margin-bottom: 20px; ">
        <img src="images/logo.png" alt="Logo" class="responsive-img" style="max-width: 150px;">
        <h4>Registrar</h4>
        <form action="register.php" method="POST">
            <div class="input-field">
                <input type="text" id="dni" name="dni" required>
                <label for="dni">DNI</label>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-field">
                <input type="text" id="nombre" name="nombre" required>
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field">
                <input type="text" id="apellido" name="apellido" required>
                <label for="apellido">Apellido</label>
            </div>
            <div class="input-field">
                <input type="text" id="direccion" name="direccion" required>
                <label for="direccion">Dirección</label>
            </div>
            <div class="input-field">
                <input type="text" id="telefono" name="telefono" required>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="text" id="ciudad" name="ciudad" required>
                <label for="ciudad">Ciudad</label>
            </div>
            <div class="input-field">
                <input type="text" id="pais" name="pais" required>
                <label for="pais">País</label>
            </div>
            <button type="submit" class="btn">Registrar</button>
        </form>
    </div>
       <script src="libraries/materialize/js/materialize.min.js"></script>

	   
	   <script>
	   // Inicializar componentes de Materialize
	   
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown);
        });
		
		document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>

</body>
</html>


