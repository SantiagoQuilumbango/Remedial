function init() {
  $("#form_usuarios").on("submit", (e) => {
    GuardarEditar(e);
  });
}

var ruta = "../../controllers/usuario.controllers.php?op=";

$().ready(() => {
  CargaLista();
});

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (ListUsuarios) => {
    console.log(ListUsuarios);
    ListUsuarios = JSON.parse(ListUsuarios);
    $.each(ListUsuarios, (index, usuario) => {
      html += `<tr>
            <td>${index + 1}</td>
            <td>${usuario.username}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.apellido}</td>
            <td>${usuario.correo_electronico}</td>
            <td>${usuario.fecha_registro}</td>
          
            <td>
              <button class='btn btn-primary' onclick='uno(${usuario.user_id})' data-bs-toggle="modal" data-bs-target="#ModalUsuarios">Editar</button>
              <button class='btn btn-danger' onclick='eliminar(${usuario.user_id})'>Eliminar</button>
            `;
    });
    $("#ListaUsuarios").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var DatosFormularioUsuario = new FormData($("#form_usuarios")[0]);
  var accion = "";

  if (document.getElementById("user_id").value != "") {
    accion = ruta + "actualizar";
  } else {
    accion = ruta + "insertar";
  }

  $.ajax({
    url: accion,
    type: "post",
    data: DatosFormularioUsuario,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        Swal.fire({
          title: "Usuarios!",
          text: "Se guardó con éxito",
          icon: "success",
        });
        CargaLista();
        LimpiarCajas();
      } else {
        Swal.fire({
          title: "Usuarios!",
          text: "Error al guardar",
          icon: "error",
        });
      }
    },
  });
};

var uno = async (user_id) => {
  document.getElementById("tituloModal").innerHTML = "Actualizar Usuario";
  $.post(ruta + "uno", { user_id: user_id }, (usuario) => {
    usuario = JSON.parse(usuario);
    document.getElementById("user_id").value = usuario.user_id;
    document.getElementById("username").value = usuario.username;
    document.getElementById("nombre").value = usuario.nombre;
    document.getElementById("apellido").value = usuario.apellido;
    document.getElementById("correo_electronico").value = usuario.correo_electronico;
    document.getElementById("fecha_registro").value = usuario.fecha_registro;
    
    
  });
};

var eliminar = (user_id) => {
  Swal.fire({
    title: "Usuarios",
    text: "¿Está seguro que desea eliminar el usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { user_id: user_id }, (respuesta) => {
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          CargaLista();
          Swal.fire({
            title: "Usuarios!",
            text: "Se eliminó con éxito",
            icon: "success",
          });
        } else {
          Swal.fire({
            title: "Usuarios!",
            text: "Error al eliminar",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("user_id").value = "";
  document.getElementById("username").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("apellido").value = "";
  document.getElementById("correo_electronico").value = "";
  document.getElementById("fecha_registro").value = "";
  document.getElementById("tituloModal").innerHTML = "Insertar Usuario";
  $("#ModalUsuarios").modal("hide");
};

init();

