function init() {
    $("#form_comentarios").on("submit", (e) => {
      GuardarEditar(e);
    });
  }


  var ruta = "../../controllers/comentario.controllers.php?op=";
  
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    $("#guardar").removeAttr("disabled");
    var html = "";
    $.get(ruta + "todos", (ListComentarios) => {
      console.log(ListComentarios);
      ListComentarios = JSON.parse(ListComentarios);
      $.each(ListComentarios, (index, comentario) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${comentario.username}</td>
              <td>${comentario.contenido}</td>
              <td>${comentario.asunto}</td>
              <td>${comentario.fecha_comentario}</td>
              <td>
                <button class='btn btn-primary' onclick='uno(${comentario.comment_id})' data-bs-toggle="modal" data-bs-target="#ModalComentarios">Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${comentario.comment_id})'>Eliminar</button>
              `;
      });
      $("#ListaComentarios").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioComentario = new FormData($("#form_comentarios")[0]);
    var accion = "";
    $("#guardar").removeAttr("disabled");
  
    if (document.getElementById("comment_id").value != "") {
      accion = ruta + "actualizar";
    } else {
      accion = ruta + "insertar";
    }
  
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioComentario,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          Swal.fire({
            title: "Comentarios!",
            text: "Se guardó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Comentarios!",
            text: "Error al guardar",
            icon: "error",
          });
        }
      },
    });
  };
  
  var uno = async (comment_id) => {
    await usuarios();
    await publicaciones();
    document.getElementById("tituloModal").innerHTML = "Actualizar Comentario";
    $.post(ruta + "uno", { comment_id: comment_id }, (comentario) => {
      comentario = JSON.parse(comentario);
      document.getElementById("comment_id").value = comentario.comment_id;
      document.getElementById("post_id").value = comentario.post_id;
      document.getElementById("user_id").value = comentario.user_id;
      document.getElementById("asunto").value = comentario.asunto;
      document.getElementById("fecha_comentario").value = comentario.fecha_comentario;
    });
    $("#guardar").removeAttr("disabled");
  };
  
  var publicaciones = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/publicacion.controllers.php?op=todos",
        async (ListaPublicaciones) => {
          ListaPublicaciones = JSON.parse(ListaPublicaciones);
          $.each(ListaPublicaciones, (index, publicacion) => {
            html += `<option value="${publicacion.post_id}">${publicacion.contenido}</option>`;
          });
          await $("#post_id").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
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

  var eliminar = (comment_id) => {
    Swal.fire({
      title: "Comentarios",
      text: "¿Está seguro que desea eliminar el comentario?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(ruta + "eliminar", { comment_id: comment_id }, (respuesta) => {
          respuesta = JSON.parse(respuesta);
          if (respuesta == "ok") {
            CargaLista();
            Swal.fire({
              title: "Comentarios!",
              text: "Se eliminó con éxito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Comentarios!",
              text: "Error al eliminar",
              icon: "error",
            });
          }
        });
      }
    });
  };
  
  var LimpiarCajas = () => {
    document.getElementById("comment_id").value = "";
    document.getElementById("post_id").value = "";
    document.getElementById("user_id").value = "";
    document.getElementById("asunto").value = "";
    document.getElementById("fecha_comentario").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Comentario";
    $("#ModalComentarios").modal("hide");
  };
 
  
  init();
  