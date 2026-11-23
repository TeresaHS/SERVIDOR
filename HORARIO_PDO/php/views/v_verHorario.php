<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Ver Horario</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>"/>
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
        <a id="volver" href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>"><p>< Volver</p></a>
        <h1><?= $datos['grupo']['codigo'] ?></h1>
        <table id="tablaHorario">
            <thead>
                <tr>
                    <th></th>
                    <th>LUNES</th>
                    <th>MARTES</th>
                    <th>MIÉRCOLES</th>
                    <th>JUEVES</th>
                    <th>VIERNES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos['horas'] as $hora) { ?>
                    <tr>
                        <td><?= $hora['hora'] ?></td>

                        <?php foreach ($datos['dias'] as $dia) { ?>
                            <?php
                                $celda = $datos['horario'][$hora['id']][$dia] ?? null;
                            ?>
                            <td>
                                <?php if ($celda) { ?>
                                    <p><strong><?= $celda['nombreModulo'] ?></strong></p>
                                    <p><?= $celda['nombreProfesor'] ?></p>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <small>Horario del grupo seleccionado</small>
    </footer>
</body>
</html>