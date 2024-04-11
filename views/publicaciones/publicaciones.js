function init() {
    $("#form_publicaciones").on("submit", (e) => {
      GuardarEditar(e);
    });
  }
  
  var ruta = "../../controllers/publicacion.controllers.php?op=";
  
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    $("#guardar").removeAttr("disabled");
    var html = "";
    $.get(ruta + "todos", (ListPublicaciones) => {
      console.log(ListPublicaciones);
      ListPublicaciones = JSON.parse(ListPublicaciones);
      $.each(ListPublicaciones, (index, publicacion) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${publicacion.username}</td>
              <td>${publicacion.contenido}</td>
              <td>${publicacion.fecha_publicacion}</td>
              <td>
                <button class='btn btn-primary' onclick='uno(${publicacion.post_id})' data-bs-toggle="modal" data-bs-target="#ModalPublicaciones">Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${publicacion.post_id})'>Eliminar</button>
              `;
      });
      $("#ListaPublicaciones").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioPublicacion = new FormData($("#form_publicaciones")[0]);
    var accion = "";
    $("#guardar").removeAttr("disabled");
  
    if (document.getElementById("post_id").value != "") {
      accion = ruta + "actualizar";
    } else {
      accion = ruta + "insertar";
    }
  
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioPublicacion,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          Swal.fire({
            title: "Publicaciones!",
            text: "Se guardó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Publicaciones!",
            text: "Error al guardar",
            icon: "error",
          });
        }
      },
    });
  };
  
  var uno = async (post_id) => {
    await usuarios();
    document.getElementById("tituloModal").innerHTML = "Actualizar Publicacion";
    $.post(ruta + "uno", { post_id: post_id }, (publicacion) => {
      publicacion = JSON.parse(publicacion);
      document.getElementById("post_id").value = publicacion.post_id;
      document.getElementById("user_id").value = publicacion.user_id;
      document.getElementById("contenido").value = publicacion.contenido;
      document.getElementById("fecha_publicacion").value = publicacion.fecha_publicacion;
    });
    $("#guardar").removeAttr("disabled");
  };
  
  var usuarios = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/usuario.controllers.php?op=todos",
        async (ListaUsuarios) => {
            ListaUsuarios = JSON.parse(ListaUsuarios);
          $.each(ListaUsuarios, (index, usuario) => {
            html += `<option value="${usuario.user_id}">${usuario.username}</option>`;
          });
          await $("#user_id").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
  };

  var eliminar = (post_id) => {
    Swal.fire({
      title: "Publicaciones",
      text: "¿Está seguro que desea eliminar la publicacion?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(ruta + "eliminar", { post_id: post_id }, (respuesta) => {
          respuesta = JSON.parse(respuesta);
          if (respuesta == "ok") {
            CargaLista();
            Swal.fire({
              title: "Publicaciones!",
              text: "Se eliminó con éxito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Publicaciones!",
              text: "Error al eliminar",
              icon: "error",
            });
          }
        });
      }
    });
  };
  
  var LimpiarCajas = () => {
    document.getElementById("post_id").value = "";
    document.getElementById("user_id").value = "";
    document.getElementById("contenido").value = "";
    document.getElementById("fecha_publicacion").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Publicacion";
    $("#ModalPublicaciones").modal("hide");
  };
 
  
  init();
  