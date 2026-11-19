<?php

    class Modulo extends Conexion {

        private $id;
        private $codigo;
        private $nombre;

        public function __construct($id = null, $codigo = null, $nombre = null){
            parent::__construct();
            $this->id = $id;
            $this->codigo = $codigo;
            $this->nombre = $nombre;
        }

        //---------------------------------------------------------------------------------------------------
        
        public function getId() {return $this->id;}
        public function getCodigo() {return $this->codigo;}
        public function getNombre() {return $this->nombre;}

        public function setId($id): void {$this->id = $id;}
        public function setCodigo($codigo): void {$this->codigo = $codigo;}
        public function setNombre($nombre): void {$this->nombre = $nombre;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO modulos (codigo, nombre) 
                    VALUES ('$this->codigo', '$this->nombre')";
            
            //echo $sql;

            return $this->ejecutar($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE modulos 
                    SET codigo = '$this->codigo', nombre = '$this->nombre' 
                    WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        public function estaEnHorario($id){
            $sql = "SELECT * FROM horario WHERE idModulo = '$id'";

            //echo $sql;

            $res = $this->ejecutar($sql);
            if(!$res['ok']) return false;
            return $res['resultado']->num_rows > 0;
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM modulos WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        //---------------------------------------------------------------------------------------------------

        public function todas(){
            $sql = "SELECT * FROM modulos";
            
            //echo $sql;
            
            return $this->fetchTodo($sql);
        }

        public function obtener($id){

            $sql = "SELECT * FROM modulos WHERE id = '$id'";
            
            //echo $sql;
            
            return $this->fetchUno($sql);
        }

        public function modulosGrupo($id){

            $sql = "SELECT DISTINCT m.id, m.codigo, m.nombre, m.horas 
                    FROM modulos m
                    INNER JOIN imparte i ON i.idModulo = m.id 
                    WHERE i.idGrupo = '$id'";

            //echo $sql;
            
            return $this->fetchTodo($sql);

        }

    }

?>