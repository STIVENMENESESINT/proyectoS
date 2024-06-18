<?php
session_start();
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:form_login.php");

$rol = $_SESSION['rol'];
if ($rol != "admin") {
    header("location:mis_publicaciones.php?mensaje=Usted no pose permisos de administrador");
}

require("../backend/admin_noticias.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagenes/logos/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">

    <title>Administrador de publicaciones</title>
</head>

<body class="bg-light bg-gradient">
    <!-- NAVBAR -->
    <div class="">
        <?php require("menu.php"); ?>
    </div>


    <!-- CONTENT -->
    <div class="container-fluid">
        <div class="container">
            <h1 class="text-center">Administrador de publicaciones</h1>
        </div>

        <?php
        if (!empty($mensaje)) {
            echo "<div class='alert alert-success text-center' role='alert'>" . $mensaje . "</div>";
        }
        ?>

        <div class="mt-3">
            <div class="row justify-content-center">
                <a href="../noticias/form_agregar.php" class="btn btn-sm btn-dark col-2 mb-4">
                    <i class="fa-solid fa-square-plus"></i>
                    Nueva
                </a>
                <div class="dropdown col-2">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtrar por autor
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="todas_publicaciones.php">Todo</a></li>
                        <?php foreach ($autores as $autor_actual): ?>
                            <li><a class="dropdown-item"
                                    href="todas_publicaciones.php?autor=<?= $autor_actual['id_usuario']; ?>">
                                    <?= $autor_actual['autor']; ?>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php if ($todas_publicaciones->rowCount() > 0): ?>

                    <div class="">
                        <div class="row shadow">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm table-bordered">
                                        <thead>
                                            <tr class="table-dark">
                                                <th scope="col" class="col-1">Imagen</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Publicada</th>
                                                <th scope="col">Autor</th>
                                                <th scope="col">Rol</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($todas_publicaciones as $noticia): ?>
                                                <tr>
                                                    <td>
                                                        <img src="../imagenes/subidas/<?php echo $noticia['imagen']; ?>"
                                                            class="img-fluid rounded-1" alt="Imagen de la noticia" width="100">
                                                    </td>
                                                    <td><small>
                                                            <?php echo $noticia['titulo']; ?>
                                                        </small></td>
                                                    <td><small>
                                                            <?php echo $noticia['fecha']; ?>
                                                        </small></td>
                                                    <td><small>
                                                            <?php echo $noticia['autor']; ?>
                                                        </small></td>
                                                    <td>
                                                        <?php if ($noticia['rol'] == "admin"): ?>
                                                            <small class="">
                                                                <?php echo "Admin"; ?></span>
                                                            <?php else: ?>
                                                                <small class="">
                                                                    <?php echo "Autor"; ?></span>
                                                                <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="../noticias/form_editar.php?id_noticia=<?php echo $noticia["id_noticia"]; ?>"
                                                                class="btn btn-sm btn-outline-primary" title="Editar"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <a href="../backend/borrar_noticia.php?id_noticia=<?php echo $noticia["id_noticia"]; ?>&imagen=<?php echo $noticia["imagen"]; ?>"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('¿Desea eliminar?')" title="Eliminar"><i
                                                                    class="fas fa-trash"></i></a>
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
                <?php else: ?>
                    <div class="container mt-3 alert alert-secondary">
                        Aún no has publicado nada
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php require("../noticias/footer.php"); ?>
</body>

</html>