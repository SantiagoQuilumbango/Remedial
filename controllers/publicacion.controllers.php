<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/publicacion.models.php");

$Publicaciones = new Publicaciones;

switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        
        $datos = $Publicaciones->todos();
        
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
   
    case 'uno':
        $post_id = $_POST["post_id"];
        
        $datos = array();
        $datos = $Publicaciones->uno($post_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

        
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $user_id = $_POST["user_id"];
        $contenido = $_POST["contenido"];
        $fecha_publicacion  = $_POST["fecha_publicacion"];
        $datos = array();
        $datos = $Publicaciones->Insertar($user_id, $contenido, $fecha_publicacion);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $post_id = $_POST["post_id"];
        $user_id = $_POST["user_id"];
        $contenido = $_POST["contenido"];
        $fecha_publicacion  = $_POST["fecha_publicacion"];
        $datos = array();
        $datos = $Publicaciones->Actualizar($post_id, $user_id, $contenido, $fecha_publicacion);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $post_id = $_POST["post_id"];
        $datos = array();
        $datos = $Publicaciones->Eliminar($post_id);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para insertar */
    
}
?>
