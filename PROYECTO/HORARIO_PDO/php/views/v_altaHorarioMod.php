<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Alta Horario - Modulos</title>
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
        <a id="volver" href="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos'?>"><p>< Volver</p></a>
        <h1><?= $datos['grupo']['codigo'] ?></h1> <!--en vez de abrir php y hacer echo, este es un atajo que pinta directamente-->

        <form id="formHorario" method="POST" action="<?= RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=altaHorarioProfesores&id='.$datos['idGrupo'] ?>">
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
                                <td>
                                    <select name="mod[<?= $dia ?>][<?= $hora['id'] ?>]" id="mod-<?= $dia ?>-<?= $hora['id'] ?>">
                                        <option value="">No asignado</option>
                                        <?php foreach ($datos['modulos'] as $m) { ?>
                                            <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <section id="botonesEdicion">
                <input type="reset" value="RESTABLECER" id="restablecer">
                <input type="submit" id="modificar" value="MODIFICAR PROFESORES">
            </section>
        </form>
    </main>
    <footer>
        <small>Los modulos son del grupo seleccionado</small>
    </footer>
</body>
</html>