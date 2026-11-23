<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Pedir Datos Modulo</title>
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
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_login&metodo=cerrarSesion'?>">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos'?>"><p>< Volver</p></a>
        <h1>VER MODULO</h1>
        <form id="formAlta" method="POST">
            <label for="codigo">Código:</label>
            <input disabled type="text" id="codigo" name="codigo" value="<?= $datos["codigo"]?>"/>
            <label for="nombre">Nombre:</label>
            <input disabled type="text" id="nombre" name="nombre" value="<?= $datos["nombre"]?>"/>
        </form>
    </main>
    <footer>
        <small>El formulario se muestra con los datos del modulo para verlos</small>
    </footer>
</body>
</html>