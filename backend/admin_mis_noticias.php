<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

extract($_REQUEST);

require("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("location:../admin/form_login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if (!isset($categoria)) {
    $instruccion = "
        SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
        FROM news 
        INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
        WHERE news.id_usuario = :id_usuario
        ORDER BY news.fecha DESC
    ";
    $params = [':id_usuario' => $id_usuario];
} else {
    $instruccion = "
        SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
        FROM news 
        INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
        WHERE news.id_usuario = :id_usuario
        AND news.categoria = :categoria
        ORDER BY news.fecha DESC
    ";
    $params = [':id_usuario' => $id_usuario, ':categoria' => $categoria];
}

try {
    $statement = $conexion->prepare($instruccion);
    $statement->execute($params);
    $mis_noticias = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($mis_noticias === false) {
        $mis_noticias = [];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $mis_noticias = [];
}

$conexion = null;
?>