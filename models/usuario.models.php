<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Usuarios
{

    public function Insertar($username, $nombre, $apellido, $correo_electronico, $fecha_registro)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO usuarios (username, nombre, apellido, correo_electronico, fecha_registro) VALUES ('$username', '$nombre', '$apellido', '$correo_electronico', '$fecha_registro')";

        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos el usuario';
        }
        $con->close();
    }

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        //$cadena = "SELECT id_libros, titulo, fecha, autor, categoria, descripcion, (ejemplares - (SELECT sum(cantidad) FROM prestamos WHERE id_libros = L.id_libros and fecha_devolucion = '')) as 'ejemplares' FROM libros L";
        $cadena = "SELECT * FROM usuarios";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($user_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuarios WHERE user_id = $user_id";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

   

    public function Actualizar($user_id, $username, $nombre, $apellido, $correo_electronico, $fecha_registro)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE usuarios SET username = '$username', nombre = '$nombre', apellido = '$apellido', correo_electronico = '$correo_electronico', fecha_registro = '$fecha_registro' WHERE user_id = $user_id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro del usuario';
        }
        $con->close();
    }

    public function Eliminar($user_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM usuarios WHERE user_id = $user_id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }

    public function login($username)
{
    try {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT user_id, username, correo_electronico FROM usuarios WHERE username='$username'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    } catch (Throwable $th) {
        return $th->getMessage();
    }
    $con->close();
}
}

