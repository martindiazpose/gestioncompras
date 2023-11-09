<?php
// Incluye el archivo de conexión
include 'api.php';
// Verifica si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $unidadDeTrabajo = $_POST["unidad_de_trabajo"];
    $codigoArticuloSAP = $_POST["codigo_articulo_sap"];
    $articulo = $_POST["articulo"];
    $cantidad = $_POST["cantidad"];
    $material = $_POST["material"];
    $color = $_POST["color"];
    $diametro = $_POST["diametro"];
    $proveedorSugerido = $_POST["proveedor_sugerido"];
    $precioEstimado = $_POST["precio_estimado"];
    $centroCosto = $_POST["centro_coste"];
    $norma = $_POST["norma"];
    $comentarios = $_POST["comentarios_detalles"];
    $adjuntarArchivo = $_FILES["adjuntar-archivo"];
    $notificarPorEmail = isset($_POST["notificar_por_email"]) ? 1 : 0; // 1 si está marcado, 0 si no

    // Aquí debes validar y sanitizar los datos según tus requerimientos

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO solicitudes (unidad_de_trabajo, codigo_articulo_sap, articulo, cantidad, material, color, diametro, proveedor_sugerido, precio_estimado, centro_costo, norma, comentarios, adjunto, notificar_por_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $sql = "INSERT INTO solicitudes (unidad_de_trabajo, codigo_articulo_sap, articulo, cantidad, material, color, diametro, proveedor_sugerido, precio_estimado, centro_costo, norma, comentarios, adjunto, notificar_por_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt->execute()) {
        // La solicitud se ha insertado correctamente
        // Redirige al usuario a la página de creación de solicitud
        header("Location: ../pages/crear_solicitud.html");
        exit();
    } else {
        // Hubo un error al insertar la solicitud
        // Puedes mostrar un mensaje de error específico aquí
        echo "Error al crear la solicitud: " . $stmt->error;
    }

// Si el formulario no se ha enviado, puedes redirigir al usuario a una página de error o mostrar un mensaje apropiado.
?>
