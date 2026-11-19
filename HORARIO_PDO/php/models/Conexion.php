<?php

    require_once RUTA_TRABAJO.'configdb.php';

    class Conexion {

        protected $conexion;

        public function __construct(){
            $dsn = "mysql:host=".SERVIDOR.";dbname=".BBDD.";charset=utf8mb4";
            $this->conexion = new PDO($dsn, USUARIO, PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        //metodos para las transacciones

        public function empezarTransaccion(){ return $this->conexion->beginTransaction(); }

        public function confirmarTransaccion(){ return $this->conexion->commit(); }

        public function deshacerTransaccion(){ return $this->conexion->rollBack(); }

        protected function ejecutar($sql){
            try{
                $resultado = $this->conexion->query($sql);
                return [
                    'ok' => true,
                    'error' => '',
                    'codigo' => 0,
                    'resultado' => $resultado,
                ];
            }catch(PDOException $e){
                return [
                    'ok' => false,
                    'error' => $e->getMessage(),
                    'codigo' => $e->errorInfo[1] ?? $e->getCode(),
                    'resultado' => null,
                ];
            }
        }

        protected function fetchTodo($sql){
            $res = $this->ejecutar($sql);
            if(!$res['ok']) return [];
            $lista = [];
            while($fila = $res['resultado']->fetch(PDO::FETCH_ASSOC)){
                $lista[] = $fila;
            }
            return $lista;
        }

        protected function fetchUno($sql){
            $res = $this->ejecutar($sql);
            if(!$res['ok']) return null;
            $fila = $res['resultado']->fetch(PDO::FETCH_ASSOC);
            if($fila === false) return null;
            return $fila;
        }

        protected function existe($sql){
            $res = $this->ejecutar($sql);
            if(!$res['ok']) return false;

            $fila = $res['resultado']->fetch(PDO::FETCH_ASSOC);
            return $fila !== false;
        }
    }
?>