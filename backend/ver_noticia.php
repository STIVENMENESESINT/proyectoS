<?php
session_start();
extract($_REQUEST);
require("conexion.php");

// Captura el parámetro 'id' de la URL
if (isset($_GET['id'])) {
    $id_noticia = $_GET['id'];

    // Utiliza comillas simples para interpolar correctamente $id_noticia
    $instruccion = "
        SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
        FROM news 
        INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
        WHERE id_noticia='$id_noticia' 
    ";

    // Ejecuta la consulta
    

    if ($resultado) {
        if ($resultado->rowCount() > 0) {
            $noticia = $resultado->fetch(PDO::FETCH_ASSOC);
            $_SESSION['ver_noticia'] = $noticia;
            header("location:../noticias/noticia.php?id=" . $noticia['id_noticia']);
        } else {
            echo "No se encontró la noticia.";
        }
    } else {
        echo "Error en la consulta: " . $conexion->errorInfo()[2];
    }
} else {
    echo "No se encontró la noticia.";
}
$conexion = null;
?>