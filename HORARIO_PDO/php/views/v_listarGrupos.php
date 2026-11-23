<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Listar Grupos</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>">
    <link rel="stylesheet" href="<?= RUTA_TRABAJO.RUTA_VISTA.'css/index.css'?>"/>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_inicio&metodo=inicio'?>">Inicio</a></li>
                <li id="indiceActivo"><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>">Grupos</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos'?>">Modulos</a></li>
                <li><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_login&metodo=cerrarSesion'?>">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>GRUPOS</h1>
        <table id="tablalistar">
            <!-- IMPORTANTE: Preguntar a isa si es mejor usar llaves o los dos puntos y su end;-->
            <?php foreach ($datos['grupos'] as $grupo) { ?> <!-- recorro la lista de grupos que me pasa el controlador-->
                <tr>
                    <th><?= $grupo['codigo'] ?></th> <!-- pinta el codigo del grupo (ej: "2DAW")-->
                    <td><?= $grupo['nombre'] ?></td> <!-- pinta el nombre del grupo (ej: "2º F.P.G.S Desarrollo de Aplicaciones Web")-->
                    <?php if ($datos['g']->tieneHorario($grupo['id'])) { ?> <!-- pregunto a la BD si ese grupo ya tiene horario-->
                        <td><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=confirmarBorrarHorarioGrupo&id='.$grupo['id']?>">🗑</a><a>✎</a><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=verHorario&id='.$grupo['id']?>">Ver</a></td>
                    <?php } else { ?>
                        <td><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=altaHorarioModulos&id='.$grupo['id']?>">+</a></td>
                    <?php } ?> 
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <small>El listar muestra el codigo y el nombre de cada grupo junto a los botones de control</small>
    </footer>
</body>
</html>