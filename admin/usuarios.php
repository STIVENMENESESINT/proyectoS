<?php
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:form_login.php");

$rol = $_SESSION['rol'];
if ($rol != "admin") {
    header("location:mis_publicaciones.php?mensaje=Usted no pose permisos de administrador");
}

require("../backend/admin_usuarios.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Administrador de usuarios</title>
</head>

<body class="bg-light bg-gradient">
    <!-- CONTENT -->
    <div class="container-fluid mb-5 min-vh-100">
        <div class="container">
            <h1 class="text-center">Administrador de usuarios</h1>
        </div>

        <?php
        if (!empty($mensaje)) {
            echo "<div class='alert alert-success text-center' role='alert'>" . $mensaje . "</div>";
        }
        ?>

        <div class="mt-3">
            <div class="row justify-content-center">
                <a href="../admin/agregar_usuario.php" class="btn btn-sm btn-dark col-2 mb-4">
                    <i class="fa-solid fa-square-plus"></i>
                    Agregar
                </a>
                <div class="dropdown col-2">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtrar por rol
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php">Todo</a></li>
                        <li><a class="dropdown-item" href="?rol_tipo=admin">Admin</a></li>
                        <li><a class="dropdown-item" href="?rol_tipo=autor">Autor</a></li>
                    </ul>
                </div>


                <div class="">
                    <div class="row shadow">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm table-bordered align-middle">
                                    <thead>
                                        <tr class="table-dark text-center">
                                            <!-- <th scope="col" class="col-1">ID</th> -->
                                            <th scope="col" class="col-1">Usuario</th>
                                            <th scope="col" class="col-1">Nombre</th>
                                            <th scope="col" class="col-1">Apellido</th>
                                            <th scope="col" class="col-1">Rol</th>
                                            <th scope="col" class="col-1">Publicaciones</th>
                                            <th scope="col" class="col-1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <tr>
                                                <td>
                                                    <small>
                                                        <?php echo $usuario['usuario']; ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        <?php echo $usuario['nombre']; ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        <?php echo $usuario['apellido']; ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        <?php echo $usuario['rol']; ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        <a 
                                                        href="todas_publicaciones.php?autor=<?php echo $usuario["id_usuario"]; ?>"
                                                        class=""> Ver
                                                        </a>
                                                    </small>
                                                </td>
                                                <td class="justify-content-center text-center">
                                                    <div class="btn-group justify-content-center text-center" role="group">
                                                        <a href="editar_usuario.php?edit_usuario=<?php echo $usuario["id_usuario"]; ?>"
                                                            class="btn btn-sm btn-outline-primary" title="Editar">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a href="../backend/borrar_usuario.php?del_usuario=<?php echo $usuario["id_usuario"]; ?>"
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('¿Desea eliminar a <?= $usuario['nombre'] . ' ' . $usuario['apellido']; ?>?')"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>