<?php

    class Profesor extends Conexion {

        private $id;
        private $nombre;
        private $login;

        public function __construct($id = null, $nombre = null, $login = null){
            parent::__construct();
            $this->id = $id;
            $this->nombre = $nombre;
            $this->login = $login;
        }

        //---------------------------------------------------------------------------------------------------

        public function getId() {return $this->id;}
        public function getNombre() {return $this->nombre;}
        public function getLogin() {return $this->login;}

        public function setId( $id): void {$this->id = $id;}
        public function setNombre( $nombre): void {$this->nombre = $nombre;}
        public function setLogin( $login): void {$this->login = $login;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO profesores (nombre, login) 
                    VALUES ('$this->nombre', '$this->login')";
            
            //echo $sql;
            
            return $this->ejecutar($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE profesores 
                    SET nombre = '$this->nombre', login = '$this->login' 
                    WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM profesores WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        //---------------------------------------------------------------------------------------------------

        public function todas(){
            $sql = "SELECT * FROM profesores";
            
            //echo $sql;
            
            return $this->fetchTodo($sql);
        }

        public function obtener($id){

            $sql = "SELECT * FROM profesores WHERE id = '$id'";
            
            //echo $sql;
            
            return $this->fetchUno($sql);
        }

        public function porModuloGrupo($idModulo, $idGrupo){
            $sql = "SELECT p.id, p.nombre, p.login
                    FROM imparte i
                    INNER JOIN profesores p ON p.id = i.idProfesor
                    WHERE i.idModulo = '$idModulo' AND i.idGrupo = '$idGrupo'";
            
            //echo $sql;
            
            return $this->fetchTodo($sql);
        }

    }

?>