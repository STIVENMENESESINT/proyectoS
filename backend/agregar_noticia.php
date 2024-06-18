<?php

session_start();

extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// Formato fecha
$fecha = date("Y-m-d"); 

$id_usuario = $_SESSION['id_usuario'];

// Manejando imágenes

// Comando SQL
$sql = "INSERT INTO news (titulo, copete, cuerpo, imagen, categoria, id_usuario, fecha)
        VALUES (:titulo, :copete, :cuerpo, :imagen, :categoria, :id_usuario, :fecha)";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':titulo', $titulo);
$instruccion->bindParam(':copete', $copete);
$instruccion->bindParam(':cuerpo', $cuerpo);
$instruccion->bindParam(':imagen', $nombrefichero);
$instruccion->bindParam(':categoria', $categoria);
$instruccion->bindParam(':id_usuario', $id_usuario);
$instruccion->bindParam(':fecha', $fecha);

// Ejecutar la consulta

// Cerrando conexión
$conexion = null; // Cierra la conexión PDO
?>