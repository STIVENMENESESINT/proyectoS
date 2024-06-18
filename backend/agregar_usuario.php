<?php
session_start();

// Verificación de sesión
if (!isset($_SESSION['usuario_logueado'])) {
    header("location:../admin/form_login.php");
    exit(); // Asegura que se detenga la ejecución después de redirigir
}

require("conexion.php");

// Captura de datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Hash de la contraseña usando password_hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Consulta SQL para agregar un usuario a la tabla
$sql = "INSERT INTO usuarios (nombre, apellido, usuario, password, rol)
        VALUES (:nombre, :apellido, :usuario, :password, :rol)";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$instruccion->bindParam(':apellido', $apellido, PDO::PARAM_STR);
$instruccion->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$instruccion->bindParam(':password', $hashed_password, PDO::PARAM_STR);
$instruccion->bindParam(':rol', $rol, PDO::PARAM_STR);

// Ejecutar la consulta
if ($instruccion->execute()) {
    // Registro exitoso
    if ($_SESSION['rol'] == "admin") {
        header("location:../admin/index.php?mensaje=Registro exitoso");
    } else {
        header("location:login.php?usuario=$usuario&password=$password");
    }
    exit(); // Asegura que se detenga la ejecución después de redirigir

} else {
    // Error en la ejecución de la consulta
    header("location:../admin/index.php?mensaje=Ha ocurrido un error en el registro");
    exit(); // Asegura que se detenga la ejecución después de redirigir
}

// Cerrar conexión
$conexion = null;
?>