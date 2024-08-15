<?php

// Incluir archivo de configuración para la conexión a la base de datos
require '../config.php'; 

// Función para verificar las credenciales de la API
function authenticate($conn) {
    // Obtener la API Key desde la URI
    $api_key = isset($_GET['api_key']) ? $_GET['api_key'] : null;


    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT * FROM api_credentials WHERE api_key = '$api_key'";
    $result = mysqli_query($conn, $query);

    // Si las credenciales no son válidas, devolver una respuesta de error
    if (mysqli_num_rows($result) !== 1) {
        http_response_code(401);
        echo json_encode(["message" => "Invalid API credentials"]);
        exit();
    }
}

// Verificar credenciales de la API
authenticate($conn);

// Determinar el método HTTP y manejar la solicitud en consecuencia
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todos los registros o uno específico si se pasa el ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM custommers WHERE id_custommer = $id";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            $query = "SELECT * FROM custommers";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($data);
        }
        break;

    case 'POST':
        // Crear un nuevo registro
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'];
        $apellido = $input['apellido'];
        $dni = $input['dni'];
        $pass = $input['pass'];
        $direccion = $input['direccion'];
        $telefono = $input['telefono'];
        $email = $input['email'];
        $ciudad = $input['ciudad'];
        $pais = $input['pais'];

        $query = "INSERT INTO custommers (nombre, apellido, dni, pass, direccion, telefono, email, ciudad, pais) VALUES ('$nombre', '$apellido', '$dni', '$pass', '$direccion', '$telefono', '$email', '$ciudad', '$pais')";
        mysqli_query($conn, $query);
        echo json_encode(["message" => "Customer created successfully"]);
        break;

    case 'PUT':
        // Actualizar un registro existente
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $input = json_decode(file_get_contents('php://input'), true);
            $nombre = $input['nombre'];
            $apellido = $input['apellido'];
            $dni = $input['dni'];
            $pass = $input['pass'];
            $direccion = $input['direccion'];
            $telefono = $input['telefono'];
            $email = $input['email'];
            $ciudad = $input['ciudad'];
            $pais = $input['pais'];

            $query = "UPDATE custommers SET nombre='$nombre', apellido='$apellido', dni='$dni', pass='$pass', direccion='$direccion', telefono='$telefono', email='$email', ciudad='$ciudad', pais='$pais' WHERE id_custommer=$id";
            mysqli_query($conn, $query);
            echo json_encode(["message" => "Customer updated successfully"]);
        } else {
            echo json_encode(["message" => "ID is required for PUT request"]);
        }
        break;

    case 'DELETE':
        // Eliminar un registro
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "DELETE FROM custommers WHERE id_custommer = $id";
            mysqli_query($conn, $query);
            echo json_encode(["message" => "Customer deleted successfully"]);
        } else {
            echo json_encode(["message" => "ID is required for DELETE request"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
