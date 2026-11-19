<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - listar Grupos</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>">
    <link rel="stylesheet" href="<?= RUTA_TRABAJO.RUTA_VISTA.'css/index.css'?>"/>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio'?>">Inicio</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>">Grupos</a></li>
                <li id="indiceActivo"><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos'?>">Modulos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=pedirDatosModulo'?>"><p>< Volver</p></a>
        <h1>ALTA MODULO</h1>
        <p class="<?= $datos['ok'] ? 'mensaje-ok' : 'mensaje-error' ?>">
            <?= $objControlador->mensaje ?>
        </p>
    </main>
    <footer>
        <small>Estado de alta de modulo</small>
    </footer>
</body>
</html>