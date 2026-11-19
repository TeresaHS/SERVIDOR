<?php

    class C_inicio {

        public $vista;
        public $mensaje;

        public function __construct($vista=null, $mensaje=null){
            $this->vista=$vista;
            $this->mensaje=$mensaje;
        }

        public function inicio() {
            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_inicio.php';
        }
    }
?>
