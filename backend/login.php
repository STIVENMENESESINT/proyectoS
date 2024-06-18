<?php
/************************ CONFIGURACIONES **************************/
session_start();

require("conexion.php");

// Saneamiento y validación de entrada
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    
    // Salting and hashing
    $salt = substr($usuario, 0, 2);
    $clave_crypt = crypt($password, $salt);

    /**************** INTERACCIÓN CON LA BASE DE DATOS *************************/
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";

    try {
        // Preparar la consulta
        $instruccion = $conexion->prepare($sql);
        // Asignar los valores a los marcadores de posición
        $instruccion->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $instruccion->bindParam(':password', $password, PDO::PARAM_STR);
        $instruccion->execute();

        $numero_filas = $instruccion->rowCount();

        // Credenciales válidas
        if ($numero_filas > 0) {
            $resultado = $instruccion->fetch(PDO::FETCH_ASSOC);
            $_SESSION['nombre'] = $resultado['nombre'];
            $_SESSION['apellido'] = $resultado['apellido'];
            $_SESSION['id_usuario'] = $resultado['id_usuario'];
           
            $_SESSION['usuario_logueado'] = "SI";
            header("Location: ../admin/index.php");
            exit();

        // Credenciales inválidas
        } else {
            $_SESSION['mensaje'] = "Usuario y contraseña incorrecto";
            header("Location: ../admin/form_login.php?mensaje=Usuario y contraseña incorrecto");
            
            exit();
        }

    // Errores en la interacción
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Fallo en la consulta: " . $e->getMessage();
        header("Location: ../admin/form_login.php?mensaje=Fallo en la consulta".$e->getMessage());
        exit();
    } finally {
        // Cerrar conexión
        $conexion = null;
    }

} else {
    $_SESSION['mensaje'] = "Debe proporcionar un usuario y contraseña.";
    header("Location: ../admin/form_login.php?mensaje=Debe proporcionar un usuario y contraseña.");
    exit();
}
?>