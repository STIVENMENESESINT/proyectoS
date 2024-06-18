<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/index.php");
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <link rel="stylesheet" href="../estaticos/css/style.css">
    <title>Agregar noticia</title>

</head>

<body class="">
    <div>
        <?php require("menu.php"); ?>
    </div>
    <div class="px-4 py-2">
        <h1 class="text-center">Crear publicación</h1>

        <form class="card p-3 shadow-lg border-3 text-bg-light" action="../backend/agregar_noticia.php" method="post"
            enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo" required>
            </div>
            <div class="mb-3">
                <label for="copete" class="form-label">Copete</label>
                <input type="text" class="form-control" id="copete" name="copete" required>
            </div>
            <div class="mb-3">
                <label for="cuerpo" class="form-label">cuerpo</label>
                <textarea rows="10" class="form-control" id="cuerpo" name="cuerpo" required></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" required></input>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="Negocios">Negocios</option>
                    <option value="Tecnologia">Tecnología</option>
                    <option value="Ciencia">Ciencia</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-sm btn-dark" id="enviar" name="enviar" value="Guardar">
                <a name="" id="" class="btn btn-sm btn-outline-danger" href="../admin/mis_publicaciones.php"
                    role="button">Cancelar</a>
            </div>
        </form>
    </div>


    <div id="librerias">
        <script>
        $(document).ready(function() {
            $('#cuerpo').summernote({
                height: 200
            });
        });
        </script>

    </div>
</body>

</html>