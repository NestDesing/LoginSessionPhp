


<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM custommers WHERE email = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Lógica para actualizar la información del perfil
    if (empty($new_password) && empty($confirm_password)) {
        // Si las contraseñas están vacías, actualiza solo los demás campos
        $update_query = "UPDATE custommers SET direccion='$direccion', telefono='$telefono', ciudad='$ciudad', pais='$pais' WHERE email='$username'";
    } elseif ($new_password === $confirm_password) {
        // Si las contraseñas no están vacías y coinciden, actualiza todos los campos incluyendo la contraseña
        $hashed_password = md5($new_password);
        $update_query = "UPDATE custommers SET direccion='$direccion', telefono='$telefono', ciudad='$ciudad', pais='$pais', pass='$hashed_password' WHERE email='$username'";
    } else {
        // Si las contraseñas no coinciden, muestra un mensaje de error
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    M.toast({html: 'Passwords no coinciden. No fue posible actualizar el perfil', displayLength: 3000});
                });
              </script>";
        exit();
    }

    // Ejecución de la consulta de actualización
    if (mysqli_query($conn, $update_query)) {
        session_destroy(); // Cierra la sesión
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    M.toast({html: 'Perfil actualizado exitosamente. Redireccionando a login...', displayLength: 3000});
                    setTimeout(function() {
                        window.location = 'login.php';
                    }, 3000);
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    M.toast({html: 'Error: No fue posible acualizar tu perfil', displayLength: 3000});
                });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - User System</title>
    <link rel="stylesheet" href="libraries/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

<body>
<?php
require 'header.php'; 
?>
    <div class="container center-align" style="margin-top: 50px; margin-bottom: 20px; ">
	
        <img src="images/logo.png" alt="Logo" class="responsive-img" style="max-width: 150px;">
        <h4>Editar Perfil</h4>
        <form action="editprofile.php" method="POST">
            <div class="input-field">
                <input type="text" id="direccion" name="direccion" value="<?php echo $user['direccion']; ?>" required>
                <label for="direccion">Dirección</label>
            </div>
            <div class="input-field">
                <input type="text" id="telefono" name="telefono" value="<?php echo $user['telefono']; ?>" required>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="input-field">
                <input type="text" id="ciudad" name="ciudad" value="<?php echo $user['ciudad']; ?>" required>
                <label for="ciudad">Ciudad</label>
            </div>
            <div class="input-field">
                <input type="text" id="pais" name="pais" value="<?php echo $user['pais']; ?>" required>
                <label for="pais">País</label>
            </div>
            <div class="input-field">
                <input type="password" id="new_password" name="new_password">
                <label for="new_password">Nuevo Password (si esta vacio no se cambia)</label>
            </div>
            <div class="input-field">
                <input type="password" id="confirm_password" name="confirm_password">
                <label for="confirm_password">Confirmar nuevo Password</label>
            </div>
            <button type="submit" class="btn">Actualizar perfil</button>
        </form>
    </div>
    <script src="libraries/materialize/js/materialize.min.js"></script>
	    <script>
        // Inicializar componentes de Materialize
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
	   <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown);
        });
    </script>
</body>
</html>

