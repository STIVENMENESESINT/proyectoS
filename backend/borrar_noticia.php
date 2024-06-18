<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:../noticias/index.php");

require("conexion.php");

$instruccion = "DELETE FROM news WHERE id_noticia='$id_noticia'";

unlink("../imagenes/subidas/" . $imagen);
$consulta = $conexion->query($instruccion);
$conexion = null;
header("location:../admin/index.php?mensaje=Publicación borrada con éxito");
?>