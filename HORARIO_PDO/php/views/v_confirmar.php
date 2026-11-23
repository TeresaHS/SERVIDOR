<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Confirmar</title>
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
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_login&metodo=cerrarSesion'?>">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="<?= $datos['urlNo'] ?>"><p>< Volver</p></a>
        <h1>CONFIRMAR</h1>
        <p id="mensaje"><?= $datos['mensaje'] ?></p>
        <div id="botonesConfirmar">
            <a id="cancelar" href="<?= $datos['urlNo'] ?>">NO</a>
            <a id="confirmar" href="<?= $datos['urlSi'] ?>">SÍ</a>
        </div>
    </main>
    <footer>
        <small>Confirma la acción para continuar</small>
    </footer>
</body>
</html>