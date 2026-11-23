<?php

    require_once RUTA_TRABAJO.RUTA_MODELO.'Conexion.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Usuario.php';

    class C_login{

        public $vista;
        public $mensaje;

        public function __construct($vista=null, $mensaje=null){
            $this->vista=$vista;
            $this->mensaje=$mensaje;
        }

        public function mostrarLogin(){
            if(isset($_SESSION['correo'])){
                header('Location: '.RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio');
                exit;
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_login.php';
            return [];
        }

        public function procesarLogin(){
            $correo = trim($_POST['correo'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if($correo === '' || $password === ''){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_login.php';
                $this->mensaje = 'El correo y la contraseña son obligatorios';
                return ['mensaje' => $this->mensaje];
            }

            $u = new Usuario();
            $usuario = $u->login($correo, $password);

            if($usuario === null){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_login.php';
                $this->mensaje = 'Correo o contraseña incorrectos';
                return ['mensaje' => $this->mensaje];
            }

            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];

            header('Location: '.RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio');
            exit;
        }

        public function cerrarSesion(){
            session_unset();
            session_destroy();
            header('Location: '.RUTA_TRABAJO.'index.php?controlador=C_login&metodo=mostrarLogin');
            exit;
        }
    }

    /*
    uso de header():

    Para que el navegador cambie de página de verdad. Uso header('Location: ...') para mandar al usuario a la URL de mi index.php con el controlador y método que toque (por ejemplo, el inicio). Si no lo hiciera, la barra de direcciones se quedaría en metodo=procesarLogin.

    Para evitar que se reenvíe el formulario. Si el usuario recarga la página (F5) después de enviar el login, el navegador le preguntaría si quiere volver a enviar los datos (POST). Al usar header(), la siguiente petición ya es un GET limpio y eso no pasa.

    Para cortar la ejecución de forma segura. Pongo header() y justo después exit;. Así me aseguro de que el script termina ahí y no se carga el HTML del login después de haber validado al usuario.
    */

?>