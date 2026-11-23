<?php

    class Usuario extends Conexion {

        private $idUsuario;
        private $correo;
        private $password; //preguntar si debo guardarlo para cuando haga el crud de usuarios o tampoco debe estar aquí como para el login
        private $rol;

        public function __construct($idUsuario = null, $correo = null, $password = null, $rol = null){
            parent::__construct();
            $this->idUsuario = $idUsuario;
            $this->correo = $correo;
            $this->password = $password;
            $this->rol = $rol;
        }

        public function login($correo, $password){
            $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password'";
            //$sql = "SELECT * FROM usuarios WHERE correo =".$correo." AND password = ".$password.";";
            return $this->fetchUno($sql);
        }
    }

?>