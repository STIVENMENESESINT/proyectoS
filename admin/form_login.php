<!-- PHP INIT CONFIGURATIONS -->
<?php
session_start();
extract($_REQUEST);
if (isset($_SESSION['usuario_logueado']))
    header("location:index.php");
?>

<!-- HMTL DOCUMENT -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">

    <title>Autenticación</title>
</head>

<body>
    <div class="">
        <?php require("menu.php"); ?>
    </div>
    <div class=" text-center">
        <div class="row">
            <div class="form-signin bg-secondary-subtle card col-8 offset-2 p-3 mt-5 shadow-lg rounded-4">
                <div class="mb-5">
                    <?php
                    if (isset($mensaje)) {
                        print("<small class='alert alert-danger'>" . $mensaje . "</small>");
                    }
                    ?>
                </div>

                <form action="../backend/login.php" method="post" class="">
                    <img class="mb-4" src="../imagenes/logos/user2.png" alt="" width="150" />
                    <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
                    <div class="mb-3 form-floating">

                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario"
                            required>


                        <label for="usuario" class="form-label">
                            Usuario
                        </label>

                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password"
                            required>

                        <label for="password" class="form-label">
                            Password
                        </label>

                    </div>

                    <div class="mb-3">

                        <input type="submit" class="btn btn-primary shadow-lg border-1" id="enviar" name="enviar"
                            value="Acceder">

                    </div>
                </form>
            </div>
        </div>
        
</body>

</html>