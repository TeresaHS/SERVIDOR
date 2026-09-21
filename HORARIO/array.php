<?php

    /*
    
    VERSION FINAL HORARIO

    El array bidimensional, con el horario, tiene que tener un índice numérico para las horas y alfanumérico para los días de la semana.
    Tendremos otro array para los colores de los módulos.

    */

    function versionFinal() {

        // creo el array de colores llamando a la funcion dedicada a ello
        $colores = crearArrayColores();

        // creo el array de horario llamando a la funcion dedicada a ello
        $horario = crearArrayHorario();

        echo "<tr> <th>HORA</th>";
   
        // con este foreach recorro soloel primer array/fila de horario 
        // y saco el nombre asociativo para la cabecera de dias de la semana

        foreach ($horario[0] as $tipoIndice => $valor) echo '<th>'.$tipoIndice.'</th>'; 
        
        // el nombre asociativo es fijo pero podría añadir if (is_string($tipoIndice)) 
        // si quiero tener más validaciones

        echo "</tr>";
        
        // con echo count($horario); puedo averiguar cuanto devuelve y saber con qué trabajo (7)

        $hora;

        // para trabajar con el indice numerico uso un for
        for($hora = 0; $hora < count($horario); $hora++){

            echo "<tr>";
            echo '<td>'.($hora+1).'</td>';
            // la hora empieza desde 1, por eso le sumo 1, el array empieza desde 0

            // con este foreach saco el modulo que toca y gracias al nombre asociativo aprovecho 
            // para acceder al valor dentro del array de colores que le corresponde
            foreach ($horario[$hora] as $modulo) {
                echo '<td style="background-color: '.$colores[$modulo].';">'.$modulo.'</td>';
            }

            echo "</tr>";
        }
    
    }

    // funcion para crear el array de colores para los modulos

    function crearArrayColores(){

        $colores = [
            "CLIENTE"   => "#B3D9F2",
            "SERVIDOR"  => "#f7e0c9",
            "INTERF."   => "#f9fadc",
            "DESPL."    => "#eafce8",
            "DIGITAL."  => "#D6C9F0",
            "PROYECTO"  => "#C2AEE8",
            "SOSTENI."  => "#E2D6F5",
            "OPTATIVA"  => "#a8b5e8",
            "TUTORIA"   => "#B8A0E0",
            "IPP2"      => "#B7B7B7",
        ];

        return $colores;
    }

    // funcion para crear el array donde almaceno los modulos por horas 
    // en arrays formando el array bidimensional de horario

    function crearArrayHorario(){

        // solo el primer array tiene nombre asociativo para crear la cabecera 
        // y practicar mas de un formato en un mismo array
        
        $horario = [
                ["L" => "IPP2","M" => "CLIENTE","X" => "IPP2","J" => "SERVIDOR","V" => "INTERF."],
                ["SERVIDOR","CLIENTE","CLIENTE","SERVIDOR","OPTATIVA"],
                ["SERVIDOR","INTERF.","CLIENTE","OPTATIVA","DIGITAL."],
                ["PROYECTO","INTERF.","INTERF.","SOSTENI.","SERVIDOR"],
                ["DESPL.","PROYECTO","DESPL.","OPTATIVA","SERVIDOR"],
                ["CLIENTE","DESPL.","DESPL.","IPP2","TUTORIA"],
                ["CLIENTE"],
            ];

        return $horario;
    }





// -------------------------------------------------------------------------------------------------------------------------------------------------

// De aquí para abajo son las pruebas de diferentes versiones que hemos mencionado en clase y otras que he pensado




    function pintarHorario() {

        $semana = ["LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES"];

        // para que a la hora de añadir al horario se le aplique la clase de css para cambiar el color
        $convalidadas = ["IPP2"];

        $horario = [
                ["IPP2", "CLIENTE", "IPP2", "SERVIDOR.", "INTERF."],
                ["SERVIDOR", "CLIENTE", "CLIENTE", "SERVIDOR", "OPTATIVA"],
                ["SERVIDOR", "INTERF.", "CLIENTE", "OPTATIVA", "DIGITAL."],
                [],
                ["PROYECTO", "INTERF.", "INTERF.", "SOSTENI.", "SERVIDOR"],
                ["DESPL.", "PROYECTO", "DESPL.", "OPTATIVA", "SERVIDOR"],
                ["CLIENTE", "DESPL.", "DESPL.", "IPP2", "TUTORIA"],
                ["CLIENTE"]
            ];

        $profesores = [
            ["ARL", "DLA", "ARL", "MDI", "MDI"],
            ["MDI", "DLA", "DLA", "MDI", "DLA"],
            ["MDI", "MDI", "DLA", "MDI", "DLA"],
            [], // importante porque sino se sale de rango, debe tener el mismo numero de elementos que el horario
            ["GTE", "MDI", "MDI", "VAS", "MDI"],
            ["GTE", "GTE", "GTE", "ARL", "MDI"],
            ["DLA", "GTE", "GTE", "ARL", "DLA"],
            ["DLA"]
        ];

        /*

        $profesores = [
            "ARL" => "ÁLVAREZ RECIO, LUIS MIGUEL",
            "GTE" => "GONZÁLEZ TRIVES, ERNESTO",
            "VAS" => "VÁZQUEZ AGUILAR, SANTIAGO",
            "DLA" => "DOMÍNGUEZ LEBRATO, ALBERTO",
            "MDI" => "MUÑOZ DOMÍNGUEZ, ISABEL"
        ];

        */

        $horas = ["8:15", "9:10", "10:05", "11:00", "11:30", "12:25", "13:20", "14:15"];

        echo "<tr>";
        echo "<th>HORA</th>";

        foreach ($semana as $dia) {
            echo '<th colspan="2">'.$dia.'</th>';
        }
        echo "</tr>";

        foreach ($horario as $hora => $modulos) {
            
            echo "<tr>";
            echo '<td>'.$horas[$hora].'</td>';

            foreach ($modulos as $elemento => $modulo) {
                echo '<td class="profesores">'.$profesores[$hora][$elemento].'</td>';

                // in_array() busca valor dentro de un array, con esto puedo preguntar si dentro
                // del array convalidadas existe el modulo que quiero añadir

                // SINTAXIS: in_array("string", $array, true);
                // true se usa para comparacion === de tipo

                if(in_array($modulo, $convalidadas, true)){
                    echo '<td class="convalidada">'.$modulo.'</td>';
                }
                else echo '<td>'.$modulo.'</td>';
                
            }
            echo "</tr>";
            
        }

    }

// -------------------------------------------------------------------------------------------------------------------------------------------------

    function pintarHorario2() {

        $convalidadas = ["IPP2"];

        $horario = [
                ["L" => "IPP2", "M" => "CLIENTE", "X" => "IPP2", "J" => "SERVIDOR.", "V" => "INTERF."],
                ["L" => "SERVIDOR", "M" => "CLIENTE", "X" => "CLIENTE", "J" => "SERVIDOR", "V" => "OPTATIVA"],
                ["L" => "SERVIDOR", "M" => "INTERF.", "X" => "CLIENTE", "J" => "OPTATIVA", "V" => "DIGITAL."],
                // [], solo si quiero dejar el espacio del recreo, que es innecesario en este ejmplo
                ["L" => "PROYECTO", "M" => "INTERF.", "X" => "INTERF.", "J" => "SOSTENI.", "V" => "SERVIDOR"],
                ["L" => "DESPL.", "M" => "PROYECTO", "X" => "DESPL.", "J" => "OPTATIVA", "V" => "SERVIDOR"],
                ["L" => "CLIENTE", "M" => "DESPL.", "X" => "DESPL.", "J" => "IPP2", "V" => "TUTORIA"],
                ["L" => "CLIENTE"]
            ];
        
        echo "<tr> <th>HORA</th>";

        // recorro el array de horarios una primera vez para poder añadir como cabecera los nombres asociativos
        // en este caso las letras de los dias de la semana
        foreach ($horario[0] as $letra => $nombre) {
            echo '<th colspan="2">'.$letra.'</th>';
        }
        echo "</tr>";
        

        // para saber que hora toca siguiendo la logica de 1ª 2ª 3ª... aprovecho el indice al recorrer el array
        // en el for each y cuando voy a añadir le sumo 1 ya qeu comienza en 0
        foreach ($horario as $hora => $modulos) {
            
            echo "<tr>";
            echo '<td>'.($hora+1).'</td>';

            // recorro los arrays de horario con otro foreach y en el apartado de profesores pongo NULL por ahora
            foreach ($modulos as $modulo) {

                echo '<td class="profesores"> NULL </td>';

                if(in_array($modulo, $convalidadas, true)){
                    echo '<td class="convalidada">'.$modulo.'</td>';
                }
                else echo '<td>'.$modulo.'</td>';
                
            }
            echo "</tr>";
            
        }

    }

// -------------------------------------------------------------------------------------------------------------------------------------------------

    function pintarHorario3() {

        // echo count($horario); para saber como funciona el count y saber el tamaño

        $convalidadas = ["IPP2"];

        $horario = [
                ["L" => "IPP2", "M" => "CLIENTE", "X" => "IPP2", "J" => "SERVIDOR.", "V" => "INTERF."],
                ["L" => "SERVIDOR", "M" => "CLIENTE", "X" => "CLIENTE", "J" => "SERVIDOR", "V" => "OPTATIVA"],
                ["L" => "SERVIDOR", "M" => "INTERF.", "X" => "CLIENTE", "J" => "OPTATIVA", "V" => "DIGITAL."],
                // [], solo si quiero dejar el espacio del recreo, que es innecesario en este ejmplo
                ["L" => "PROYECTO", "M" => "INTERF.", "X" => "INTERF.", "J" => "SOSTENI.", "V" => "SERVIDOR"],
                ["L" => "DESPL.", "M" => "PROYECTO", "X" => "DESPL.", "J" => "OPTATIVA", "V" => "SERVIDOR"],
                ["L" => "CLIENTE", "M" => "DESPL.", "X" => "DESPL.", "J" => "IPP2", "V" => "TUTORIA"],
                ["L" => "CLIENTE"]
            ];
        
        $profesores = [
            ["ARL", "DLA", "ARL", "MDI", "MDI"],
            ["MDI", "DLA", "DLA", "MDI", "DLA"],
            ["MDI", "MDI", "DLA", "MDI", "DLA"],
            // [], en este caso no hace falta ya que el horario no tiene en cuenta el recreo
            ["GTE", "MDI", "MDI", "VAS", "MDI"],
            ["GTE", "GTE", "GTE", "ARL", "MDI"],
            ["DLA", "GTE", "GTE", "ARL", "DLA"],
            ["DLA"]
        ];

        echo "<tr> <th>HORA</th>";

        foreach ($horario[0] as $letra => $nombre) {
            echo '<th colspan="2">'.$letra.'</th>';
        }
        echo "</tr>";
        
        // recorro con for para añadir las horas en numero, usando el count

        $hora;
        $turno;

        // el count devuelve 7 por lo que debo usar < para no salirme del array al recorrerlo
        // tener en cuenta si se añade en el array el hueco del patio, en este caso no 

        for($hora = 0; $hora < count($horario); $hora++){

            echo "<tr>";
            echo '<td>'.($hora+1).'</td>';

            $turno=0;

            foreach ($horario[$hora] as $elemento => $modulo) {

                echo '<td class="profesores">'.$profesores[$hora][$turno].'</td>';
                // echo '<td class="profesores">'.$profesores[$hora][$elemento].'</td>';
                
                if(in_array($modulo, $convalidadas, true)){
                    echo '<td class="convalidada">'.$modulo.'</td>';
                }
                else echo '<td>'.$modulo.'</td>';
                
                // aumentar para tener el indice que cree antes
                $turno++;
            }
            echo "</tr>";
            
        }
    }

// -------------------------------------------------------------------------------------------------------------------------------------------------

    function pintarHorario4() {

        $convalidadas = ["IPP2"];

        $horario = [
                    [
                        ["ARL", "L" => "IPP2"],
                        ["DLA", "M" => "CLIENTE"],
                        ["ARL", "X" => "IPP2"],
                        ["MDI", "J" => "SERVIDOR."],
                        ["MDI", "V" => "INTERF."],
                    ],
                    [
                        ["MDI", "L" => "SERVIDOR"],
                        ["MDI", "M" => "CLIENTE"],
                        ["DLA", "X" => "CLIENTE"],
                        ["MDI", "J" => "SERVIDOR"],
                        ["DLA", "V" => "OPTATIVA"],
                    ],
                    [
                        ["MDI", "L" => "SERVIDOR"],
                        ["MDI", "M" => "INTERF."],
                        ["DLA", "X" => "CLIENTE"],
                        ["MDI", "J" => "OPTATIVA"],
                        ["DLA", "V" => "DIGITAL."],
                    ],
                    // [], solo si quiero dejar el espacio del recreo, que es innecesario en este ejemplo
                    [
                        ["GTE", "L" => "PROYECTO"],
                        ["MDI", "M" => "INTERF."],
                        ["MDI", "X" => "INTERF."],
                        ["VAS", "J" => "SOSTENI."],
                        ["MDI", "V" => "SERVIDOR"],
                    ],
                    [
                        ["GTE", "L" => "DESPL."],
                        ["GTE", "M" => "PROYECTO"],
                        ["GTE", "X" => "DESPL."],
                        ["ARL", "J" => "OPTATIVA"],
                        ["MDI", "V" => "SERVIDOR"],
                    ],
                    [
                        ["DLA", "L" => "CLIENTE"],
                        ["GTE", "M" => "DESPL."],
                        ["GTE", "X" => "DESPL."],
                        ["ARL", "J" => "IPP2"],
                        ["DLA", "V" => "TUTORIA"],
                    ],
                    [
                        ["DLA", "L" => "CLIENTE"],
                    ],
                ];

        echo "<tr> <th>HORA</th>";

        foreach ($horario[0] as $array) {

            foreach ($array as $tipoIndice => $valor) {
                if (is_string($tipoIndice)) echo '<th colspan="2">'.$tipoIndice.'</th>';
            }
        }
        

        echo "</tr>";

        $hora;
        for($hora = 0; $hora < count($horario); $hora++){

            echo "<tr>";
            echo '<td>'.($hora+1).'</td>';

            foreach ($horario[$hora] as $elemento => $modulo) {

                echo '<td class="profesores">'.$horario[$hora][$elemento][0].'</td>';
                
                foreach($horario[$hora][$elemento] as $indice => $contenido){
                    if(is_string($indice)){
                        if(in_array($contenido, $convalidadas, true)){
                            echo '<td class="convalidada">'.$contenido.'</td>';
                        }
                        else echo '<td>'.$contenido.'</td>';
                    }
                }
            }
            echo "</tr>";
        }
    

    }

?>
