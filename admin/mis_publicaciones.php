<?php
session_start();
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado'])) {
    header("location:form_login.php");
    exit();
}

require("../backend/admin_mis_noticias.php");
$rol = $_SESSION['rol'];
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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">

    <title>Mis publicaciones</title>
</head>

<body>
    <!-- NAVBAR -->
    <div class="">
        <?php require("menu.php"); ?>
    </div>

    <!-- CONTENT -->
    <div class="container-fluid">
        <div class="container">
            <h1 class="text-center">Mis publicaciones</h1>
        </div>

        <?php
        if (!empty($mensaje)) {
            echo "<div class='alert alert-success text-center' role='alert'>" . $mensaje . "</div>";
        }
        ?>

        <div class="container mt-3">
            <div class="row justify-content-center">
                <a href="../noticias/form_agregar.php" class="btn btn-sm btn-outline-primary col-2 mb-4">
                    <i class="fa-solid fa-square-plus"></i> Nueva
                </a>
                <div class="dropdown col-2">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtrar por categoría
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mis_publicaciones.php">Todo</a></li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Negocios">Negocios</a></li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Tecnologia">Tecnología</a>
                        </li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Ciencia">Ciencia</a></li>
                    </ul>
                </div>

                <?php foreach ($mis_noticias as $noticia): ?>
                <div class="col-12 mb-1">
                    <div class="card p-3 shadow border-black rounded-1 mb-3">
                        <div class="row g-0">
                            <div class="col-md-1 col-sm-12 justify-content-center align-items-center card-header">
                                <img src="../imagenes/subidas/<?php echo htmlspecialchars($noticia['imagen']); ?>"
                                    class="img-fluid card-img rounded-1" alt="Imagen de la tarjeta" width="100">
                            </div>
                            <div class="col-md-10 col-sm-12 card-body">
                                <div class="">
                                    <h4 class="card-title mb-1 border-bottom">
                                        <?php echo htmlspecialchars($noticia['titulo']); ?>
                                    </h4>
                                </div>
                                <div class="card-text">
                                    <small>Publicada el:
                                        <span class="badge text-bg-dark">
                                            <?php echo htmlspecialchars($noticia['fecha']); ?>
                                        </span>
                                    </small>
                                    <small>
                                        <?php if ($rol == "admin"): ?>
                                        <span class="badge text-bg-danger">
                                            <?php echo htmlspecialchars($rol); ?>
                                        </span>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <div class="">
                                    <div
                                        class="d-flex flex-column flex-wrap justify-content-center text-center align-items-center w-100">
                                        <a href="../noticias/form_editar.php>" class="btn btn-sm btn-dark m-1"><i
                                                class="fa-solid fa-pencil"></i></a>
                                        <a href="../backend/borrar_noticia.php>"
                                            class="btn btn-sm btn-outline-danger m-1"
                                            onclick="return confirm('¿Está seguro de que desea borrar esta noticia?');"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="container mt-3 alert alert-secondary">
                    Aún no has publicado nada
                </div>

            </div>
        </div>
    </div>

</body>

</html>