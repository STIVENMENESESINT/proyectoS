<?php
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:form_login.php");

require("../backend/admin_mis_noticias.php");
$rol= $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Mis publicaciones</title>
</head>

<body>
    <!-- CONTENT -->
    <div class="container-fluid min-vh-100">
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
                    <i class="fa-solid fa-square-plus"></i>
                    Nueva
                </a>
                <div class="dropdown col-2">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtrar por categoría
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mis_publicaciones.php">Todo</a></li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Negocios">Negocios</a></li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Tecnologia">Tecnología</a></li>
                        <li><a class="dropdown-item" href="mis_publicaciones.php?categoria=Ciencia">Ciencia</a></li>
                    </ul>
                </div>
                <?php if ($mis_noticias->rowCount() > 0): ?>
                    <?php foreach ($mis_noticias as $noticia): ?>
                        <div class="col-12 mb-1">
                            <div class="card p-3 shadow border-black rounded-1 mb-3">
                                <div class="row g-0">
                                    <div class="col-md-1 col-sm-12 justify-content-center align-items-center card-header">
                                        <!-- src="<php print($noticia['imagen'])";?> -->
                                        <img src="../imagenes/subidas/<?php print($noticia['imagen']); ?>"
                                            class="img-fluid card-img rounded-1" alt="Imagen de la tarjeta" width="100">
                                    </div>
                                    <div class="col-md-10 col-sm-12 card-body">
                                        <div class="">
                                            <h4 class="card-title mb-1 border-bottom">
                                                <?php print($noticia['titulo']); ?>
                                            </h4>
                                        </div>
                                        <div class="card-text">
                                            <small>Publicada el:
                                                <span class="badge text-bg-dark">
                                                    <?php print($noticia['fecha']) ?>
                                                </span>
                                            </small>
                                            <small>
                                                    <?php 
                                                        if($rol == "admin"){
                                                            print("
                                                            <span class='badge text-bg-danger'>
                                                                $rol
                                                            </span>
                                                            ");
                                                        } else {
                                                            print('');
                                                        } 
                                                    ?>

                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="">
                                            <div
                                                class=" d-flex flex-column flex-wrap justify-content-center text-center slign-items-center w-100">

                                                <a href="<?php print('../noticias/form_editar.php?id_noticia=' . $noticia["id_noticia"] . ''); ?>"
                                                    class="btn btn-sm btn-dark m-1"><i class="fa-solid fa-pencil"></i></a>
                                                <a href="<?php print('../backend/borrar_noticia.php?id_noticia=' . $noticia["id_noticia"] . '&imagen=' . $noticia["imagen"] . ''); ?>"
                                                    class="btn btn-sm btn-outline-danger m-1"
                                                    onclick="return confirm(&quot; Desea eliminar &quot;)"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="container mt-3 alert alert-secondary">
                    Aún no has publicado nada
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>