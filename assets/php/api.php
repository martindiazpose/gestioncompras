<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
header("Content-Type: application/json");

// Conexión a la base de datos
$host = "localhost";
$usuario_db = "root";
$contrasena_db = "Facil.2022";
$nombre_db = "usuariosgc";
$conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar una respuesta JSON
$response = ["success" => false, "message" => ""];

// Endpoint para validar el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL para buscar al usuario por nombre de usuario (nombre_usuario)
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email); // Usar el valor del campo de correo electrónico para buscar al usuario
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        if ($resultado !== null) {
            // Resto del código de verificación de contraseñas aquí
        } else {
            echo "La consulta no devolvió un resultado válido.";
        }
    } else {
        echo "Error al ejecutar la consulta SQL.";
    }

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $contrasena_hash = $fila["contrasena"];

        if (password_verify($password, $contrasena_hash)) {
            // Las credenciales son correctas
            $response["success"] = true;
            $response["message"] = "Inicio de sesión exitoso";
        } else {
            // Credenciales incorrectas
            $response["message"] = "Credenciales incorrectas";
        }
    } else {
        // Usuario no encontrado
        $response["message"] = "Usuario no encontrado";
    }
} else {
    // Si la solicitud no es un POST válida
    $response["message"] = "Solicitud no válida";
}

// Devolver la respuesta como JSON
echo json_encode($response);

// Cerrar la conexión a la base de datos
$conexion->close();
?>
