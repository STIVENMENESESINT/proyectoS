<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");

require("../backend/conexion.php");

$instruccion = "SELECT * FROM usuarios WHERE id_usuario = '$edit_usuario'";
$resultado = $conexion->query($instruccion);
$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <title>DIARIO</title>
</head>

<body>
    <div class="">
        <?php require("menu.php"); ?>
    </div>
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1> Editar registro de usuario </h1>
            </div>
            <form action="../backend/editar_usuario.php" method="POST"
                class="col-8 offset-2 card text-bg-light shadow-lg p-3 mt-3" scheme>

                <div class=" input-group input-group-sm mb-3">
                    <label for="usuario" class="input-group-text">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario"
                        value="<?= $resultado['usuario']; ?>" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label for="nombre" class="input-group-text">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"
                        value="<?= $resultado['nombre']; ?>" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label for="apellido" class="input-group-text">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido"
                        value="<?= $resultado['apellido']; ?>" required>
                </div>
                <!--                 <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="password" value="< $resultado['password']; ?>" required>
                </div> -->
                <div class="input-group input-group-sm mb-3">
                    <label for="categoria" class="input-group-text">Rol</label>
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="admin" <?php if ($resultado['rol'] == "admin")
                            print("selected"); ?>>Admin
                        </option>
                        <option value="autor" <?php if ($resultado['rol'] == "autor")
                            print("selected"); ?>>Autor
                        </option>
                    </select>
                </div>

                <!-- Campo oculto -->
                <input type="hidden" name="id_usuario" value="<?= $resultado['id_usuario'] ?>">
                <input type="hidden" name="password" value="<?= $resultado['password']?>">

                <div class="col-12 justify-content-center text-center">
                    <button class="btn btn-sm btn-dark" type="submit">Editar</button>
                    <a href="index.php" class="btn btn-sm btn-outline-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

</body>

</html>