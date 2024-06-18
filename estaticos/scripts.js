document.getElementById("usuario").addEventListener("blur", function () {
  var nombreUsuario = this.value;
  var nombreUsuarioError = document.getElementById("nombre-usuario-error");

  // Realiza la solicitud Ajax para verificar la disponibilidad del nombre de usuario
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../backend/usuario_disponible.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var respuesta = xhr.responseText;

        // La respuesta debe ser "disponible" o "ocupado"
        if (respuesta === "disponible") {
          nombreUsuarioError.textContent = "Nombre de usuario disponible.";
        } else if (respuesta === "ocupado") {
          nombreUsuarioError.textContent = "Nombre de usuario ya ocupado.";
        }
      }
    }
  };

  // Envia el nombre de usuario al servidor para verificar
  xhr.send("nombreUsuario=" + encodeURIComponent(nombreUsuario));
});
