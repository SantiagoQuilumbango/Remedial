<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/comentario.models.php");

$Comentarios = new Comentarios;

switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        
        $datos = $Comentarios->todos();
        
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
   
    case 'uno':
        $comment_id = $_POST["comment_id"];
        
        $datos = array();
        $datos = $Comentarios->uno($comment_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

     
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $post_id = $_POST["post_id"];
        $user_id = $_POST["user_id"];
        $asunto = $_POST["asunto"];
        $fecha_comentario  = $_POST["fecha_comentario"];
        $datos = array();
        $datos = $Comentarios->Insertar($post_id, $user_id, $asunto, $fecha_comentario);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $comment_id = $_POST["comment_id"];
        $post_id = $_POST["post_id"];
        $user_id = $_POST["user_id"];
        $asunto = $_POST["asunto"];
        $fecha_comentario  = $_POST["fecha_comentario"];
        $datos = array();
        $datos = $Comentarios->Actualizar($comment_id, $post_id, $user_id, $asunto, $fecha_comentario);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $comment_id = $_POST["comment_id"];
        $datos = array();
        $datos = $Comentarios->Eliminar($comment_id);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para insertar */
    
}
?>
