
<?php

    require_once './config.php';

    $controlador = $_GET['controlador'] ?? CONTROLADOR_POR_DEFECTO; //pregunto que controlador quiero, default traigo de config
    $metodo = $_GET['metodo'] ?? METODO_POR_DEFECTO; //pregunto que metodo quiero, default traigo de config
    
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
