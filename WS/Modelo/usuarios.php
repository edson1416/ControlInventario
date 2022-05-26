<?php
    class Usuario
    {
        private $conexion;//variable para la conexion
        private $tabla='usuarios';//nombre de la tabla

        //campos de la tabla
        public $idUsuario;
        public $nombre;
        public $correo;
        public $clave;
        public $nivel;

        //constructor para conectar
        public function __construct($db)
        {
            $this->conexion=$db;
        }

        //mostrar Todos los Usuarios ===================================@KILLUARE====================================
        public function mostrar()
        {
            //creamos la consulta
            $consulta= 'SELECT * FROM ' . $this->tabla;

            $stmt= $this->conexion->prepare($consulta);

            //ejecutar la consulta
            $stmt->execute();

            //retorno el resultado
            return $stmt;
        }

        //mostrar Usuarios con parametros ===============================@KILLUARE=================================

        public function mostrar_parametro()
        {
            //creamos la consulta
            $consulta= 'SELECT * FROM ' . $this->tabla . ' where idUsuario= ? LIMIT 0,1' ;
            
            $stmt= $this->conexion->prepare($consulta);

            //enlazar parametro
            $stmt->bindParam(1,$this->idUsuario);
 
            //ejecutar la consulta
            $stmt->execute();

            //lo creamos para traer los datos
            $row = $stmt->fetch(PDO:: FETCH_ASSOC);
            
            //metemos los datos que regresan en las variables que creamos
            $this->idUsuario=$row['idUsuario'];
            $this->nombre=$row['nombre'];
            $this->correo=$row['correo'];
            $this->clave=$row['clave'];
            $this->nivel=$row['nivel'];
        }
        //login==========================================================@KILLUARE======================================
        public function login()
        {
            //creamos la consulta
            $consulta= 'SELECT * FROM ' . $this->tabla . ' where correo= ?  and clave= ? ' ;

            $stmt= $this->conexion->prepare($consulta);

            //enlazar parametro
            $stmt->bindParam(1,$this->correo);
            $stmt->bindParam(2,$this->clave);
 
 
            //ejecutar la consulta
            $stmt->execute();

            //lo creamos para traer los datos
            $row = $stmt->fetch(PDO:: FETCH_ASSOC);
            
            //metemos los datos que regresan en las variables que creamos
            $this->idUsuario=$row['idUsuario'];
            $this->nombre=$row['nombre'];
            $this->correo=$row['correo'];
            $this->clave=$row['clave'];
            $this->nivel=$row['nivel'];

        }

        //insertar========================================================@KILLUARE====================================
        public function insertar()
        {
            //consulta

            $consulta='INSERT INTO ' . $this->tabla .' 
                SET 
                    idUsuario= :idUsuario,
                    nombre= :nombre,
                    correo= :correo,
                    clave= :clave,
                    nivel= :nivel';
        
            $stmt= $this->conexion->prepare($consulta);

            //flitros de caracteres 
            $this->idUsuario =htmlspecialchars(strip_tags($this->idUsuario));
            $this->nombre =htmlspecialchars(strip_tags($this->nombre));
            $this->correo =htmlspecialchars(strip_tags($this->correo));
            $this->clave =htmlspecialchars(strip_tags($this->clave));
            $this->nivel =htmlspecialchars(strip_tags($this->nivel));

            //insertamos en la DB
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':clave', $this->clave);
            $stmt->bindParam(':nivel', $this->nivel);
             
            if($stmt->execute())
            {
                //si se ejecuta retorna verdadero
                return true;
            } 

            //print("error : %s. \n", $stmt->error); si no falso
            return false;
        }

        // actualizar======================================================@KILLUARE=======================
        public function actualizar()
        {
            //consulta idUsuario= :idUsuario,

            $consulta='UPDATE ' . $this->tabla .' 
                SET 
                    idUsuario= :idUsuario,
                    nombre= :nombre,
                    correo= :correo,
                    clave= :clave,
                    nivel= :nivel
                where 
                    idUsuario=:idUsuario';

            $stmt= $this->conexion->prepare($consulta);

            //flitros de caracteres

            $this->nombre =htmlspecialchars(strip_tags($this->nombre));
            $this->correo =htmlspecialchars(strip_tags($this->correo));
            $this->clave =htmlspecialchars(strip_tags($this->clave));
            $this->nivel =htmlspecialchars(strip_tags($this->nivel));
            //de ultimo va el parametro del usuario actulizar
            $this->idUsuario =htmlspecialchars(strip_tags($this->idUsuario));

            // vincular datos
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':clave', $this->clave);
            $stmt->bindParam(':nivel', $this->nivel);
            //de ultimo va el parametro del usuario
            $stmt->bindParam(':idUsuario', $this->idUsuario);
             
            if($stmt->execute())
            {
                return true;
            } 
            
            //print("error : %s. \n", $stmt->error);
            return false;
        }

        //ELIMINAR========================================================@KILLUARE========================

        public function eliminar()
        {
            //creamos la consulta 

            $consulta=' DELETE FROM ' . $this->tabla .' where idUsuario = :idUsuario';

            $stmt= $this->conexion->prepare($consulta);

            //metemos el parametro
            $this->idUsuario =htmlspecialchars(strip_tags($this->idUsuario));

            //lo vinculamos
            $stmt->bindParam(':idUsuario', $this->idUsuario);

            //validamos
            if($stmt->execute())
            {
                return true;
            } 
            return false;
        }
    }
    /*  |||  ||| ||| |||    |||    |||   |||  |||||||  ||||||||  |||||||| 
        ||| ||   ||| |||    |||    |||   ||| |||   ||| |||   ||| |||
        |||||    ||| |||    |||    |||   ||| ||||||||| |||||||   ||||||
        ||| ||   ||| |||    |||    |||   ||| |||   ||| |||  |||  ||| 
        |||  ||| ||| |||||| |||||| ||||||||| |||   ||| |||   ||| |||||||| */ 
?>
