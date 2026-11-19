<?php

    class Horario extends Conexion {

        private $id;
        private $dia; // 'L','M','X','J','V'
        private $idGrupo;
        private $idModulo;
        private $idProfesor;
        private $idHora;

        // el constructor lleva ese nombre por defecto en las clases de php  --> __construct
        public function __construct($id = null, $dia = null, $idGrupo = null, $idModulo = null, $idProfesor = null, $idHora = null){
            parent::__construct();
            $this->id = $id;
            $this->dia = $dia;
            $this->idGrupo = $idGrupo;
            $this->idModulo = $idModulo;
            $this->idProfesor = $idProfesor;
            $this->idHora = $idHora;
        }

        //---------------------------------------------------------------------------------------------------

        public function getId() {return $this->id;}
        public function getDia() {return $this->dia;}
        public function getIdGrupo() {return $this->idGrupo;}
        public function getIdModulo() {return $this->idModulo;}
        public function getIdProfesor() {return $this->idProfesor;}
        public function getIdHora() {return $this->idHora;}

        public function setId( $id): void {$this->id = $id;}
        public function setDia( $dia): void {$this->dia = $dia;}
        public function setIdGrupo( $idGrupo): void {$this->idGrupo = $idGrupo;}
        public function setIdModulo( $idModulo): void {$this->idModulo = $idModulo;}
        public function setIdProfesor( $idProfesor): void {$this->idProfesor = $idProfesor;}
        public function setIdHora( $idHora): void {$this->idHora = $idHora;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO horario (dia, idGrupo, idModulo, idProfesor, idHora) 
                    VALUES ('$this->dia', '$this->idGrupo', '$this->idModulo', '$this->idProfesor', '$this->idHora')";
            
            //echo $sql;
            
            return $this->ejecutar($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE horario 
                    SET dia = '$this->dia', idGrupo = '$this->idGrupo', idModulo = '$this->idModulo', idProfesor = '$this->idProfesor', idHora = '$this->idHora' 
                    WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM horario WHERE id = '$this->id'";

            //echo $sql;

            return $this->ejecutar($sql);
        }

        //---------------------------------------------------------------------------------------------------

        public function todas(){
            $sql = "SELECT * FROM horario";
            
            //echo $sql;
            
            return $this->fetchTodo($sql);
        }

        public function obtener($id){

            $sql = "SELECT * FROM horario WHERE id = '$id'";
            
            //echo $sql;
            
            return $this->fetchUno($sql);
        }

        /**
         * Devuelve el horario de un grupo indexado por [idHora][dia],
         * listo para pintar la tabla en la vista.
         * Ejemplo: $horario[3]['L'] => fila con idModulo, idProfesor, codigo, modulo, profesor...
         */
        public function porGrupo($idGrupo){

            $sql = "SELECT h.id, h.dia, h.idGrupo, h.idModulo, h.idProfesor, h.idHora,
                           m.codigo AS codigoModulo, m.nombre AS nombreModulo,
                           p.nombre AS nombreProfesor
                    FROM horario h
                    INNER JOIN modulos m ON m.id = h.idModulo
                    INNER JOIN profesores p ON p.id  = h.idProfesor
                    WHERE h.idGrupo = '$idGrupo'";

            //Uso alias porque sino, al hacer fetch_assoc() tendría dos columnas llamadas nombre (la del módulo y la del profesor) y la segunda pisaría a la primera en el array asociativo

            //echo $sql;

            $lista = [];

            $res = $this->ejecutar($sql);
            if(!$res['ok']) return $lista;

            while($fila = $res['resultado']->fetch_assoc()){

                //$lista[1]['L'] = $fila; ejemplo
                $lista[$fila['idHora']][$fila['dia']] = $fila;

                /* $lista queda:
                [
                    1 => [
                        'L' => [
                            'id'             => 1,
                            'dia'            => 'L',
                            'idHora'         => 1,
                            'idModulo'       => 10,
                            'nombreModulo'   => 'DASP - Digitalización Aplicada',
                            'nombreProfesor' => 'Ana',
                             etc
                        ],
                    ],
                ]
                */
            }

            return $lista;
        }

        public function borrarPorGrupo($idGrupo){
            $sql = "DELETE FROM horario WHERE idGrupo = '$idGrupo'";

            //echo $sql;
            
            return $this->ejecutar($sql);
        }

    }

?>