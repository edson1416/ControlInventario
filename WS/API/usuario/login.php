<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //archivos que necesitamos
    include_once '../../DB/conexion.php';
    include_once '../../Modelo/usuarios.php';

    //instanciamos la clase de la DB
    $basedatos=new BaseDatos();

    //ejecutamos el metodo de conectar
    $db=$basedatos->conectar();

    //instanciar la clase de la tabla 
    $usuarios=new Usuario($db);

    //determinamos si el parametro no es null
    $usuarios->correo=isset($_GET['correo']) ? $_GET['correo'] : die();
    $usuarios->clave=isset($_GET['clave']) ? $_GET['clave'] : die();

    //ejecutamos el metodo 

    $usuarios->login();

    //crear array

    $usuarios_arr=array(
        'idUsuario'=>$usuarios->idUsuario,
        'nombre'=>$usuarios->nombre,
        'correo'=>$usuarios->correo,
        'clave'=>$usuarios->clave,
        'nivel'=>$usuarios->nivel
    );

    //crear jason
    print_r(json_encode($usuarios_arr));
    
?>