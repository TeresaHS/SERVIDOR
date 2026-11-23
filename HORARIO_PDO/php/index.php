
<?php

    session_start(); //comienzo la sesion

    require_once './config.php';

    $controlador = $_GET['controlador'] ?? CONTROLADOR_POR_DEFECTO; //pregunto que controlador quiero, default traigo de config
    $metodo = $_GET['metodo'] ?? METODO_POR_DEFECTO; //pregunto que metodo quiero, default traigo de config
    
    if($controlador !== 'C_login'){ //si el controlador no es el de sesion
        if(!isset($_SESSION['correo'])){ //si no hay una sesion creada manda a iniciar sesion
            header('Location: index.php?controlador=C_login&metodo=mostrarLogin');
            exit;
        }
    }

    $ruta = RUTA_TRABAJO.RUTA_CONTROLADOR.$controlador.'.php'; //guardo el controlador elegido

    if (!file_exists($ruta)) { //compruebo que existe ese archivo
        http_response_code(404);
        echo 'Controlador no encontrado';
        exit;
    }

    require $ruta; //traigo el controlador elegido

    $objControlador = new $controlador(); //instancio controlador
    $datos = $objControlador->$metodo(); //llamo el metodo elegido
    require $objControlador->vista; //llamo vista correspondiente
    
?>
