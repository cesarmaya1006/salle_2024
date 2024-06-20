$(document).ready(function () {

});

function mostrar_foto(){
    var archivo = document.getElementById("foto").files[0];
    var reader = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend = function () {
        document.getElementById("fotoUsuario").src = reader.result;
      }
    }
  }
