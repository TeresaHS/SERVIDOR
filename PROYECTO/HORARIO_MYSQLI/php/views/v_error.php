<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Error</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>">
    <link rel="stylesheet" href="<?= RUTA_TRABAJO.RUTA_VISTA.'css/index.css'?>"/>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio'?>">Inicio</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>">Grupos</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos'?>">Modulos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="<?= $datos['volver'] ?? RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio' ?>"><p>< Volver</p></a>
        <h1>ERROR</h1>
        <p class="mensaje-error">
            <?= $datos['mensaje'] ?>
        </p>
    </main>
    <footer>
        <small>Ha ocurrido un error al procesar la solicitud</small>
    </footer>
</body>
</html>