<?php
    class BaseDatos
    {
        //parametros de la DB
        private $host='localhost'; //servidor
        private $db='ejemplodbWS';//bases de datos
        private $user='root';//usuario
        private $pass='';//contra

        //variable para la conexion
        private $conexion;

        //conectar a la base de datos

        public function conectar()
        {
            $this->conexion=null;

            try
            {
                $this->conexion=new PDO('mysql:host=' . $this->host . '; dbname=' . $this->db,$this->user,$this->pass);

                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                

            }
            catch(PDOException $e)
            {
                echo 'Error en la conexion: '.$e->getMessage();
            }

            return $this->conexion;

        }

    }
    /*  |||  ||| ||| |||    |||    |||   |||  |||||||  ||||||||  |||||||| 
        ||| ||   ||| |||    |||    |||   ||| |||   ||| |||   ||| |||
        |||||    ||| |||    |||    |||   ||| ||||||||| |||||||   ||||||
        ||| ||   ||| |||    |||    |||   ||| |||   ||| |||  |||  ||| 
        |||  ||| ||| |||||| |||||| ||||||||| |||   ||| |||   ||| |||||||| */ 
?>
