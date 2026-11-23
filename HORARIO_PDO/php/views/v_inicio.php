<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Listar Grupos</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>">
    <link rel="stylesheet" href="<?= RUTA_TRABAJO.RUTA_VISTA.'css/index.css'?>"/>
</head>
<body id="cuerpoInicio">
    <header>
        <nav>
            <ul>
                <li id="indiceActivo"><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio'?>">Inicio</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>">Grupos</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos'?>">Modulos</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_login&metodo=cerrarSesion'?>">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main id="cajaInicio">
        <div id="cajaInicioIzq">
            <h1 id="tituloInicial">GESTIÓN DE HORARIOS</h1>
            <h2>Proyecto Servidor 2º Desarrollo Aplicaciones Web</h2>
            <small>Proyecto creado por: Teresa Hernández Sánchez</small>
        </div>
        <div id="cajaInicioDer">
            <img src="<?= RUTA_TRABAJO.RUTA_VISTA.'images/logo.webp' ?>" alt="logo evg"/>
        </div>
    </main>
</body>
</html>