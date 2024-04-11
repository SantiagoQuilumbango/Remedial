<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/usuario.models.php");
//require_once("../models/Accesos.models.php");
$Usuarios = new Usuarios;
//$Accesos = new Accesos;
switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Usuarios->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $user_id = $_POST["user_id"];
        $datos = array();
        $datos = $Usuarios->uno($user_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $username = $_POST["username"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo_electronico = $_POST["correo_electronico"];
        $fecha_registro = $_POST["fecha_registro"];
       
        $datos = array();
        $datos = $Usuarios->Insertar($username, $nombre, $apellido, $correo_electronico, $fecha_registro);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo_electronico = $_POST["correo_electronico"];
        $fecha_registro = $_POST["fecha_registro"];
        
        $datos = array();
        $datos = $Usuarios->Actualizar($user_id, $username, $nombre, $apellido, $correo_electronico, $fecha_registro);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $user_id = $_POST["user_id"];
        $datos = array();
        $datos = $Usuarios->Eliminar($user_id);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para insertar */
    case 'login':
        $username = $_POST['username'];
        $correo_electronico = $_POST['correo_electronico'];
    
        // TODO: Si las variables están vacías regresa con error
        if (empty($username) or empty($correo_electronico)) {
            header("Location:../index.php?op=2");
            exit();
        }
    
        try {
            $datos = array();
            $datos = $Usuarios->login($username);
            $res = mysqli_fetch_assoc($datos);
        } catch (Throwable $th) {
            header("Location:../index.php?op=1");
            exit();
        }
        // TODO: Control de si existe el registro en la base de datos
        try {
            if (is_array($res) and count($res) > 0) {
                if ($correo_electronico == $res["correo_electronico"]) {
    $_SESSION["username"] = $res["username"];
    $_SESSION["correo_electronico"] = $res["correo_electronico"];
    $_SESSION["user_id"] = $res["user_id"];
    header("Location:../views/home.php");
    exit();
} else {
    // Manejo de errores o redireccionamiento en caso de que la contraseña no coincida


                    header("Location:../index.php?op=1");
                    exit();
                }
            } else {
                header("Location:../index.php?op=1");
                exit();
            }
        } catch (Exception $th) {
            echo ($th->getMessage());
        }
        break;
        
}



