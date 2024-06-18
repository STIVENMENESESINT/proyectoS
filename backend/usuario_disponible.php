<?php
// Incluye la configuración de la conexión a la base de datos
require('conexion.php'); // Asegúrate de reemplazar 'conexion.php' con el nombre de tu archivo de conexión.

// Verifica si se ha recibido el nombre de usuario mediante POST
if (isset($_POST['nombreUsuario'])) {
    $nombreUsuario = $_POST['nombreUsuario'];

    // Prepara la consulta SQL para verificar si el nombre de usuario ya existe
    $consulta = $conexion->prepare("SELECT usuario FROM usuarios WHERE usuario = :nombreUsuario");
    $consulta->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
    $consulta->execute();

    // Obtiene el resultado de la consulta
    $resultado = $consulta->rowCount();

    // Comprueba si el nombre de usuario ya está ocupado o disponible
    if ($resultado > 0) {
        echo 'ocupado';
    } else {
        echo 'disponible';
    }
} else {
    echo 'No se ha recibido el nombre de usuario desde el formulario.';
}
?>