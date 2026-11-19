<?php

    require_once RUTA_TRABAJO.'configdb.php';

    class Conexion {

        protected $conexion;

        public function __construct(){
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //hace que mysqli lance excepciones en lugar de advertencias cuando ocurren errores
            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
            $this->conexion->set_charset("utf8");
        }

        //metodos para las transacciones

        public function empezarTransaccion(){ return $this->conexion->begin_transaction(); }

        public function confirmarTransaccion(){ return $this->conexion->commit(); }

        public function deshacerTransaccion(){ return $this->conexion->rollback(); }

        protected function ejecutar($sql){
            try{
                $resultado = $this->conexion->query($sql);
                return [
                    'ok' => true,
                    'error' => '',
                    'codigo' => 0,
                    'resultado' => $resultado,
                ];
            }catch(mysqli_sql_exception $e){
                return [
                    'ok' => false,
                    'error' => $e->getMessage(),
                    'codigo' => $e->getCode(),
                    'resultado' => null,
                ];
            }
        }

        protected function fetchTodo($sql){
            $res = $this->ejecutar($sql);
            if(!$res['ok']) return [];
            $lista = [];
            while($fila = $res['resultado']->fetch_assoc()){
                $lista[] = $fila;
            }
            return $lista;
        }

        protected function fetchUno($sql){
            $res = $this->ejecutar($sql);
            if(!$res['ok']) return null;
            if($res['resultado']->num_rows === 0) return null;
            return $res['resultado']->fetch_assoc();
        }
    }
?>