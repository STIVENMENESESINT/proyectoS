<?php

extract($_REQUEST);

// Importaciones
require("conexion.php");

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

$id_usuario = $_SESSION['id_usuario'];

if (!isset($autor)) {

    $instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    ORDER BY news.fecha DESC
";
} else {
    $instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    WHERE news.id_usuario = '$autor'
    ORDER BY news.fecha DESC
    ";
}

$instruccion_autores = "
    SELECT news.id_usuario, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor
    FROM news
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    GROUP BY usuarios.id_usuario
    ORDER BY CONCAT(usuarios.nombre, ' ', usuarios.apellido)
";

$todas_publicaciones = $conexion->query($instruccion);
$autores = $conexion->query($instruccion_autores);
$conexion = null;
?>