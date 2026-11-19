<?php

    class Hora extends Conexion {

        private $id;
        private $hora;

        public function __construct($id = null, $hora = null){
            parent::__construct();
            $this->id = $id;
            $this->hora = $hora;
        }

        //---------------------------------------------------------------------------------------------------

        public function getId() {return $this->id;}
        public function getHora() {return $this->hora;}

        public function setId( $id): void {$this->id = $id;}
        public function setHora( $hora): void {$this->hora = $hora;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO horas (hora) 
                    VALUES ('$this->hora')";
            
            //echo $sql;
            
            return $this->ejecutar($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE horas 
                    SET hora = '$this->hora'
                    WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM horas WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        //---------------------------------------------------------------------------------------------------

        public function todas(){
            $sql = "SELECT * FROM horas";
            
            //echo $sql;
            
            return $this->fetchTodo($sql);
        }

        public function obtener($id){

            $sql = "SELECT * FROM horas WHERE id = '$id'";
            
            //echo $sql;
            
            return $this->fetchUno($sql);
        }
    }

?>