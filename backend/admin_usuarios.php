<?php
extract($_REQUEST);

// Importaciones
require("conexion.php");

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

$id_usuario = $_SESSION['id_usuario'];

if (!isset($rol_tipo)) {
    $instruccion = "
    SELECT * FROM usuarios 
    ORDER BY nombre, apellido
";
} else {
    $instruccion = "
    SELECT * FROM usuarios 
    WHERE rol = '$rol_tipo'
    ORDER BY nombre, apellido
";
}

$usuarios = $conexion->query($instruccion);
$conexion = null;
?>