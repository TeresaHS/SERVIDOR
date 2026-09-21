<?php 
    include "array.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO</title>
    <meta name="author" content="Teresa Hernández Sánchez"/>

    <!-- ESTE ES EL CODIGO EMBEBIDO DE GOOGLE FONTS, QUE LO DA PARA COPIAR Y PEGAR -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">

    <link href="./estilo.css" rel="stylesheet"/>
</head>
<body>
    
    <header>
        <h1 id="titulo">HORARIO 2DAW 26/27</h1>
        <hr id="separador"/>
    </header>
    <main>
        <section id="horario">

                <table id="tabla">
                    <caption>⚠︎ Las asignaturas pintadas de gris están convalidadas</caption>
                    
                    <?php
                        // creacón de la tabla horario version final para la tarea
                        versionFinal();

                        /*

                        //pintarHorario();
                        
                        // esta funcion se encarga de generar el contenido de la tabla de horario gracias
                        // a un array bidimensional donde guardo los modulos por hora. Además se encarga 
                        // de poner los dias de la semana como cabecera y las horas en el lateral
                        
                        // ---------------------------------------------------------------------------
                        
                        //pintarHorario2();

                        // esta tabla generada trabaja con nombres asociativos dentro del array bidimensional
                        // y usandolos como cabecera del horario
                        
                        // ---------------------------------------------------------------------------

                        //pintarHorario3();

                        // version con numerico bucle for con count y asociativo con foreach
                        

                        // ---------------------------------------------------------------------------

                        // ---------------------------------------------------------------------------

                        //pintarHorario4();

                        // version con array dentro de cada hora guardando profesor y modulo
                        // trabaja con indice numerico y nombre asociado


                        */
                    ?>
                    
                </table>
                
        </section>
        <section id="listado">
            <div>
                <ul>
                    <li>MÓDULOS</li>
                    <ul>
                        <li><span class="modulos">IPP2 -</span> Itinerario Personal para la Empleabilidad II</li>
                        <li id="cliente"><span class="modulos">DWENC -</span> Desarrollo Web en Entorno Cliente</li>
                        <li id="servidor"><span class="modulos">DWESV -</span> Desarrollo Web en Entorno Servidor</li>
                        <li id="interface"><span class="modulos">DINW -</span> Diseño de Interfaces Web</li>
                        <li id="despliegue"><span class="modulos">DEAPW -</span> Despliegue de Aplicaciones Web</li>
                        <li id="digitalizacion"><span class="modulos">DASP -</span> Digitalización Aplicada al Sistema Productivo</li>
                        <li id="sostenibilidad"><span class="modulos">SASP -</span> Sostenibilidad Aplicada al Sistema Productivo</li>
                        <li id="proyecto"><span class="modulos">PIMOD -</span> Proyecto Intermodular</li>
                        <li id="optativa"><span class="modulos">OPT -</span> Optativa</li>
                    </ul>
                </ul>
            </div>
            <div>
                <ul>
                    <li>PROFESORES</li>
                    <ul>
                        <li>ÁLVAREZ RECIO, LUIS MIGUEL</li>
                        <li>GONZÁLEZ TRIVES, ERNESTO</li>
                        <li>VÁZQUEZ AGUILAR, SANTIAGO</li>
                        <li>DOMÍNGUEZ LEBRATO, ALBERTO</li>
                        <li>MUÑOZ DOMÍNGUEZ, ISABEL</li>
                    </ul>
                </ul>
            </div>
        </section>
    </main>
    <footer>
        <small>Hecho por: Teresa Hernández Sánchez</small>
    </footer>
</body>
</html>