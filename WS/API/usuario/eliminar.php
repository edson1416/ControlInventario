<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    //archivos que necesitamos
    include_once '../../DB/conexion.php';
    include_once '../../Modelo/usuarios.php';

    //instanciamos la clase de la DB
    $basedatos=new BaseDatos();

    //ejecutamos el metodo de conectar
    $db=$basedatos->conectar();

    //instanciar la clase de la tabla 
    $usuarios=new Usuario($db);

    //me temos en una variable
    //json_decode transforma un string a json
    //file_get_contents devuelve el fichero a un string
    $data=json_decode(file_get_contents("php://input"));

    //ingresar id para eliminar y lo metemos en el json

    $usuarios->idUsuario=$data->idUsuario;

    //eliminar usuarios
    if($usuarios->eliminar())
    {
        echo json_encode(array('message' => 'usuario Eliminado'));
    }
    else
    {
        echo json_encode(array('message' => 'usuario no Eliminado'));
    }
?>