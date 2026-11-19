<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Listar Modulos</title>
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
        <h1>MODULOS</h1>
        <a id="anadirFila" href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=pedirDatosModulo'?>">+</a>
        <table id="tablalistar">
            <?php foreach ($datos['modulos'] as $modulo) { ?>
                <tr>
                    <th><?= $modulo['codigo'] ?></th>
                    <td><?= $modulo['nombre'] ?></td>
                    <td><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=confirmarBajaModulo&id='.$modulo['id']?>">🗑</a><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=traerModulo&id='.$modulo['id']?>">✎</a><a href="<?= RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=verModulo&id='.$modulo['id']?>">Ver</a></td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <small>El listar muestra el codigo y el nombre de cada modulo junto a los botones de control</small>
    </footer>
</body>
</html>