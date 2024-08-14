<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$username = $_SESSION['username'];
$query = "SELECT * FROM custommers WHERE email = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - User System</title>
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
        <h4>Mi perfil:</h4>
        <ul class="collection">
            <li class="collection-item">Name: <?php echo $user['nombre']; ?></li>
            <li class="collection-item">Surname: <?php echo $user['apellido']; ?></li>
            <li class="collection-item">Email: <?php echo $user['email']; ?></li>
            <li class="collection-item">Address: <?php echo $user['direccion']; ?></li>
            <li class="collection-item">Phone: <?php echo $user['telefono']; ?></li>
            <li class="collection-item">City: <?php echo $user['ciudad']; ?></li>
            <li class="collection-item">Country: <?php echo $user['pais']; ?></li>
        </ul>
        <a href="editprofile.php" class="btn">Editar perfil</a>
    </div>
      <script src="libraries/materialize/js/materialize.min.js"></script>
	  	   <script>
		   // Inicializar componentes de Materialize
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown);
        });
    </script>
</body>
</html>