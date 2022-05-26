<?php
    // Headers
    //puede ir o no como tu quieras 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //los archivos que requerimos
    include_once '../../DB/conexion.php';
    include_once '../../Modelo/usuarios.php';

    //instanciar la conexion
    $basedatos=new BaseDatos();

    //ejecutamos el metodo conectar para poder conectarnos
    $db=$basedatos->conectar();

    //instanciar la clase de al tabla para poder hacer el CRUD 
    $usuarios=new Usuario($db);

    // metemos en una variable el resultado del metodo que queremos ejecutar
    $resultado=$usuarios->mostrar();

    //luego contamos ese resultado
    $num=$resultado->rowCount();

    //verificar el contenido
    if($num>0)
    {
        //si hay contenido
        //creamos un array para los datos
        $usuarios_array=array();

        //lo recorremos
        while($row=$resultado->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $usuarios_item=array(
                'idUsuario' => $idUsuario,
                'nombre' => $nombre,
                'correo' => $correo,
                'clave' => $clave,
                'nivel' => $nivel
            );
           
            //insertar los elementos del array usuarios_item en el array usuarios_array
            array_push($usuarios_array,$usuarios_item);

        }
        //imprimimoso el array como un json
        print json_encode($usuarios_array);
    }
    else
    {
        //mensaje por si no ose en cuentra ningun dato
        print json_encode(array('mensaje: '=>'no hay usuarios'));
    }

?>