<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Comentarios
{

    public function Insertar($post_id, $user_id, $asunto, $fecha_comentario)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO comentarios (post_id, user_id, asunto, fecha_comentario) VALUES ('$post_id', '$user_id', '$asunto', '$fecha_comentario')";
        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos el comentario';
        }
        $con->close();
    }

    /*public function InsertarImagen($id_prestamos)
    {
        if ($_FILES["imagenPrestamo"]["name"] != '') {
            $extesion = explode(".", $_FILES["imagenPrestamo"]["name"]);
            $nombreNuevo = $id_prestamos . '.' . end($extesion);
            $destino = "../public/images/prestamos/" . $nombreNuevo;  //para guardar la imagen en el servidor    ../
            copy($_FILES["imagenPrestamo"]["tmp_name"], $destino);
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            //para guardar en la base de datos ../../
            $destino = '../' . $destino; //para guardar en la base de datos
            $cadena = "UPDATE Prestamos SET imagen = '$destino' WHERE id_prestamos = $id_prestamos";
            if (mysqli_query($con, $cadena)) {
                return 'ok';
            } else {
                return 'Error al guardar la imagen';
            }
        }
    }*/

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT Usuarios.user_id, Usuarios.username, Publicaciones.post_id, Publicaciones.contenido, Comentarios.comment_id, Comentarios.asunto, Comentarios.fecha_comentario FROM Comentarios INNER JOIN Publicaciones ON Comentarios.post_id = Publicaciones.post_id INNER JOIN Usuarios ON Comentarios.user_id = Usuarios.user_id";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

   
  

    public function uno($comment_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        //$cadena = "SELECT prestamos.id:prestamos, libros.titulo, usuarios.nombre, libros.id_libros, usuarios.id_usuarios, Prestamos.fecha_salida, Prestamos.fecha_devolucion FROM Prestamos INNER JOIN Usuarios ON Prestamos.id_usuarios = Usuarios.id_usuarios INNER JOIN Libros ON Prestamos.id_libros = Libros.id_libros WHERE id_prestamos = $id_prestamos";
        $cadena = "SELECT * FROM comentarios WHERE comment_id = $comment_id";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Actualizar($comment_id, $post_id, $user_id, $asunto, $fecha_comentario)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE comentarios SET post_id = '$post_id', user_id = '$user_id', asunto = '$asunto', fecha_comentario = '$fecha_comentario' WHERE comment_id = $comment_id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro del comentario';
        }
        $con->close();
    }

    public function Eliminar($comment_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM comentarios WHERE comment_id = $comment_id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
?>
