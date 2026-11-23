<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Iniciar Sesión</title>
    <link rel="icon" type="image/*" href="<?= RUTA_TRABAJO.RUTA_VISTA.'images/icono.png'?>">
    <link rel="stylesheet" href="<?= RUTA_TRABAJO.RUTA_VISTA.'css/index.css'?>"/>
</head>
<body class="cuerpoLogin">
    <header>
        <div>
            <h1>GESTIÓN DE HORARIOS</h1>
            <span>Proyecto Servidor · 2º DAW</span>
        </div>
    </header>
    <main>
        <h1>INICIAR SESIÓN</h1>
        
        <?php if(!empty($datos['mensaje'])){ ?>
            <p class="mensaje-error"><?= $datos['mensaje'] ?></p>
        <?php } ?>
        <form id="formSesion" method="POST" action="<?= RUTA_TRABAJO.'index.php?controlador=C_login&metodo=procesarLogin'?>">
            <label for="correo">Usuario:</label>
            <input type="text" id="correo" name="correo">
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
            
            <input type="submit" value="Entrar"/>
        </form>
    </main>
    <footer>
        <p>Creado por <strong>Teresa Hernández Sánchez</strong></p>
        <p>Proyecto de Gestión de Horarios · Curso 2026/2027</p>
    </footer>
</body>
</html>