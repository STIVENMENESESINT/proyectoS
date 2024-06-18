<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:../noticias/index.php");

require("conexion.php");

$instruccion = "DELETE FROM usuarios WHERE id_usuario='$del_usuario'";

$consulta = $conexion->query($instruccion);
$conexion = null;
header("location:../admin/index.php?mensaje=Usuario borrado con éxito");
?>