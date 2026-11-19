<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Alta Horario - Profesores</title>
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
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="javascript:history.back()"><p>< Volver</p></a> <!-- PREGUNTAR A ISA SI PUEDO USAR ESTA INSTRUCCION AUNQUE SEA DE JAVASCRIPT O SI HAY ALGUNA MANERA DE HACERLO POR PHP PARECIDO-->
        <!-- ESTO QUITA LOS CAMBIOS: <a id="volver" href=" abrir php -> RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=altaHorarioModulos&id='.datos['idGrupo'] <- cerrar php "><p>< Volver</p></a>-->
        <h1><?= $datos['grupo']['codigo'] ?></h1>
        <?php if(!empty($datos['mensaje'])){ ?>
            <p class="mensaje-error"><?= $datos['mensaje'] ?></p>
        <?php } ?>
        <form id="formHorario" method="POST" action="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=guardarHorario'?>">
            <input type="hidden" name="idGrupo" value="<?= $datos['idGrupo'] ?>">

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

                            <?php foreach ( $datos['dias'] as $dia) { ?>
                                <?php
                                    $celda = $datos['celdas'][$dia][$hora['id']] ?? null;
                                    $modulo = $celda['modulo'] ?? null;
                                    $profesores = $celda['profesores'] ?? [];
                                ?>
                                <td>
                                    <?php if ($modulo) { ?>
                                        <input type="hidden" name="mod[<?= $dia ?>][<?= $hora['id'] ?>]" value="<?= $modulo['id'] ?>">
                                    <?php } ?>
                                    <input type="text" id="mod-<?= $dia ?>-<?= $hora['id'] ?>" disabled value="<?= $modulo ? $modulo['nombre'] : '' ?>">

                                    <?php if ($modulo && count($profesores) > 0) { ?>
                                        <?php foreach ($profesores as $i => $p) { ?>
                                            <input type="radio" id="prof-<?= $dia ?>-<?= $hora['id'] ?>-<?= $p['id'] ?>" name="prof[<?= $dia ?>][<?= $hora['id'] ?>]" value="<?= $p['id'] ?>" <?= $i === 0 ? 'checked' : '' ?>> <!-- para que se seleccione por defecto la primera opcion -->
                                            <label for="prof-<?= $dia ?>-<?= $hora['id'] ?>-<?= $p['id'] ?>">
                                                <?= $p['nombre'] ?>
                                            </label><br>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <section id="botonesEdicion">
                <input type="reset" value="RESTABLECER" id="restablecer">
                <input type="submit" id="modificar" value="DAR DE ALTA HORARIO">
            </section>
        </form>
    </main>
    <footer>
        <small>Los profesores son del módulo seleccionado</small>
    </footer>
</body>
</html>