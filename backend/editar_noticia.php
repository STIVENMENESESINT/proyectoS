<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("location:index.php");
    exit();
}

require("conexion.php");

// Verificar si se ha enviado un archivo de imagen
$copiarArchivo = false;
if (isset($_FILES['imagen']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "../imagenes/subidas/";
    $idUnico = time();
    $nombrefichero = $idUnico . "-" . $_FILES['imagen']['name'];
    $copiarArchivo = true;
} else {
    // Si no se envió una nueva imagen, usar la imagen existente
    $nombrefichero = isset($imagenedit) ? $imagenedit : '';
}

// Eliminar la imagen antigua si se está actualizando con una nueva
if ($copiarArchivo && isset($imagenedit) && !empty($imagenedit)) {
    unlink($nombreDirectorio . $imagenedit);
}

// Actualizar la noticia en la base de datos
$sql = "UPDATE news 
        SET titulo = :titulo, copete = :copete, cuerpo = :cuerpo, imagen = :imagen, categoria = :categoria 
        WHERE id_noticia = :id_noticia";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':titulo', $titulo, PDO::PARAM_STR);
$instruccion->bindParam(':copete', $copete, PDO::PARAM_STR);
$instruccion->bindParam(':cuerpo', $cuerpo, PDO::PARAM_STR);
$instruccion->bindParam(':imagen', $nombrefichero, PDO::PARAM_STR);
$instruccion->bindParam(':categoria', $categoria, PDO::PARAM_STR);
$instruccion->bindParam(':id_noticia', $id_noticia, PDO::PARAM_INT);

// Ejecutar la consulta

// Cerrar conexión
$conexion = null;

// Redireccionar a la página de edición con mensaje de éxito
header("location:../admin/index.php?mensaje=Publicación editada con éxito&id_noticia=" . $id_noticia);
?>