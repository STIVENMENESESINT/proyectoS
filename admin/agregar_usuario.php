<?php
session_start();
extract($_REQUEST);
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
                <?php if ($_SESSION['rol'] == "1"): ?>
                <h1> Registrar nuevo usuario</h1>
                <?php else: ?>
                <h1>Crear cuenta autor</h1>
                <?php endif; ?>
            </div>
            <form action="../backend/agregar_usuario.php" method="POST"
                class="bg-secondary-subtle py-5 col-8 offset-2 card text-bg-light shadow-lg p-3 mt-3">

                <div class=" input-group input-group-sm mb-3">
                    <label for="usuario" class="input-group-text">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required>
                    <div id="nombre-usuario-error" class="input-group-text"></div>

                </div>

                <div class="input-group input-group-sm mb-3">
                    <label for="nombre" class="input-group-text">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label for="apellido" class="input-group-text">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label for="password" class="input-group-text">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <?php if ($_SESSION['rol'] == "admin"): ?>
                <div class="input-group input-group-sm mb-3">
                    <label for="categoria" class="input-group-text">Rol</label>
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="admin" selected>Admin</option>
                        <option value="autor">Autor</option>
                    </select>
                </div>
                <?php else: ?>
                <input type="hidden" value="autor" name="rol">
                <?php endif; ?>
                <div class="col-12 justify-content-center text-center">
                    <button class="btn btn-sm btn-dark" id="crear_cuenta_btn" type="submit">Crear cuenta</button>
                    <a href="index.php" class="btn btn-sm btn-outline-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <?php require("../noticias/footer.php"); ?>

    <script>
    document.getElementById("usuario").addEventListener("input", function() {
        var nombreUsuario = this.value;
        var nombreUsuarioError = document.getElementById("nombre-usuario-error");
        var crearCuentaButton = document.getElementById("crear_cuenta_btn");

        // Realiza la solicitud Ajax para verificar la disponibilidad del nombre de usuario
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../backend/usuario_disponible.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var respuesta = xhr.responseText;

                    // Verificar si el nombre de usuario cumple con las condiciones
                    var regex = /^[a-zA-Z0-9]+$/; // Expresión regular que permite letras y números
                    var esValido = regex.test(nombreUsuario);

                    if (nombreUsuario !== "") {
                        if (esValido) {
                            // La respuesta debe ser "disponible" o "ocupado"
                            if (respuesta === "disponible") {
                                crearCuentaButton.disabled = false;
                                nombreUsuarioError.classList.remove("text-danger");
                                nombreUsuarioError.classList.add("text-success");
                                nombreUsuarioError.textContent = "Disponible";
                            } else if (respuesta === "ocupado") {
                                crearCuentaButton.disabled = true;
                                nombreUsuarioError.classList.remove("text-success");
                                nombreUsuarioError.classList.add("text-danger");
                                nombreUsuarioError.textContent = "No disponible";
                            }
                        } else {
                            crearCuentaButton.disabled = true;
                            nombreUsuarioError.classList.remove("text-success");
                            nombreUsuarioError.classList.add("text-danger");
                            nombreUsuarioError.textContent = "Inválido";
                        }
                    } else {
                        nombreUsuarioError.textContent = "";
                    }
                }
            }
        };

        // Envia el nombre de usuario al servidor para verificar
        xhr.send("nombreUsuario=" + encodeURIComponent(nombreUsuario));
    });
    </script>
</body>

</html>