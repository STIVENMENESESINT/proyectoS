<?php
session_start();
require("../backend/conexion.php");

// Verificar sesión iniciada
if (!isset($_SESSION['usuario_logueado'])) {
    header("location:index.php");
    exit(); // Terminar la ejecución del script después de redirigir
}

// Verificar si se ha recibido el parámetro id_noticia
if (!isset($_REQUEST['id_noticia'])) {
    header("location:../admin/mis_publicaciones.php");
    exit();
}

$id_noticia = $_REQUEST['id_noticia'];

// Obtener la noticia específica para editar
$instruccion = "SELECT * FROM news WHERE id_noticia = :id_noticia";
$stmt = $conexion->prepare($instruccion);
$stmt->bindParam(':id_noticia', $id_noticia, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró la noticia
if (!$resultado) {
    $mensaje = "La noticia no existe.";
    // Puedes redirigir o mostrar un mensaje de error
    // header("location:../admin/mis_publicaciones.php");
    // exit();
}

// Cerrar la conexión a la base de datos
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
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
</head>

<body>
    <?php require("menu.php"); ?>

    <div class="container">
        <h1>Editar Noticia</h1>

        <!-- Mostrar mensaje de confirmación o error -->
        <?php if (isset($mensaje)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
        <?php endif; ?>

        <form action="../backend/editar_noticia.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required
                    value="<?php echo htmlspecialchars($resultado['titulo']); ?>">
            </div>
            <div class="mb-3">
                <label for="copete" class="form-label">Copete</label>
                <input type="text" class="form-control" id="copete" name="copete" required
                    value="<?php echo htmlspecialchars($resultado['copete']); ?>">
            </div>
            <div class="mb-3">
                <label for="cuerpo" class="form-label">Cuerpo</label>
                <textarea name="cuerpo" id="cuerpo" cols="30" rows="10" class="form-control"
                    required><?php echo htmlspecialchars($resultado['cuerpo']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
                <img src="../imagenes/subidas/<?php echo htmlspecialchars($resultado['imagen']); ?>" width="80px">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="Negocios" <?php if ($resultado['categoria'] == "Negocios") echo "selected"; ?>>
                        Negocios</option>
                    <option value="Tecnologia" <?php if ($resultado['categoria'] == "Tecnologia") echo "selected"; ?>>
                        Tecnología</option>
                    <option value="Ciencia" <?php if ($resultado['categoria'] == "Ciencia") echo "selected"; ?>>Ciencia
                    </option>
                </select>
            </div>
            <!-- Campos ocultos para enviar información necesaria -->
            <input type="hidden" name="imagenedit" value="<?php echo htmlspecialchars($resultado['imagen']); ?>">
            <input type="hidden" name="id_noticia" value="<?php echo htmlspecialchars($resultado['id_noticia']); ?>">

            <!-- Botones para enviar o cancelar la edición -->
            <div class="mb-3">
                <input type="submit" class="btn btn-dark" id="enviar" name="enviar" value="Guardar">
                <a href="../admin/mis_publicaciones.php" class="btn btn-outline-primary">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Script para inicializar el editor Summernote -->
    <script>
    $(document).ready(function() {
        $('#cuerpo').summernote({
            height: 200
        });
    });
    </script>

</body>

</html>