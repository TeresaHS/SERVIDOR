<?php

    class Grupo extends Conexion {

        private $id;
        private $codigo;
        private $nombre;

        public function __construct($id = null, $codigo = null, $nombre = null) {
            parent::__construct();
            $this->id = $id;
            $this->codigo = $codigo;
            $this->nombre = $nombre;
        }

        //---------------------------------------------------------------------------------------------------

        public function getId() {return $this->id;}
        public function getCodigo() {return $this->codigo;}
        public function getNombre() {return $this->nombre;}

        public function setId( $id): void {$this->id = $id;}
        public function setCodigo( $codigo): void {$this->codigo = $codigo;}
        public function setNombre( $nombre): void {$this->nombre = $nombre;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO grupos (codigo, nombre) 
                    VALUES ('$this->codigo', '$this->nombre')";
            
            //echo $sql;
            
            return $this->ejecutar($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE grupos 
                    SET codigo = '$this->codigo', nombre = '$this->nombre' 
                    WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM grupos WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        //---------------------------------------------------------------------------------------------------

        public function todas(){
            $sql = "SELECT * FROM grupos";

            //echo $sql;

            return $this->fetchTodo($sql);
        }

        public function obtener($id){

            $sql = "SELECT * FROM grupos WHERE id = '$id'";
            
            //echo $sql;
            
            return $this->fetchUno($sql);
        }

        public function tieneHorario($id){
            $sql = 'SELECT * FROM horario WHERE idGrupo = '.$id.'';

            //echo $sql;

            $res = $this->ejecutar($sql);
            if(!$res['ok']) return false;

            $fila = $res['resultado']->fetch(PDO::FETCH_ASSOC);
            return $fila !== false;
        }

        public function borrarHorarioPorGrupo($id){
            $sql = "DELETE FROM horario WHERE idGrupo = '$id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }
    }

?>