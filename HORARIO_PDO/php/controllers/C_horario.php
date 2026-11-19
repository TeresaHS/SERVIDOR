<?php

    require_once RUTA_TRABAJO.RUTA_MODELO.'Conexion.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Hora.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Modulo.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'/Horario.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Grupo.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Profesor.php';

    class C_horario {

        public $vista;
        public $mensaje;

        public function __construct($vista=null, $mensaje=null){
            $this->vista=$vista;
            $this->mensaje=$mensaje;
        }

        public function listarGrupos() {

            $g = new Grupo();
            
            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_listarGrupos.php';

            return [
                'grupos' => $g->todas(),
                'g' => $g,  // para poder llamar a tieneHorario() en la vista
            ];
        }

        public function altaHorarioModulos() {

            $id = $_GET["id"] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $horaM = new Hora();
            $moduloM = new Modulo();

            $datos = [
                'idGrupo' => $id,
                'horas' => $horaM->todas(),
                'modulos' => $moduloM->modulosGrupo($id),
                'dias' => ['L','M','X','J','V'],
            ];

            $g = new Grupo();
            $datos['grupo'] = $g->obtener($id);

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_altaHorarioMod.php';

            return $datos;
        }

        private function hayAlgunModulo($modulosPost){
            foreach($modulosPost as $porHora){
                foreach($porHora as $idModulo){
                    if(!empty($idModulo)) return true;
                }
            }
            return false;
        }

        public function altaHorarioProfesores(){

            $idGrupo = $_POST['idGrupo'] ?? $_GET['id'] ?? null;
            $modulosPost = $_POST['mod'] ?? [];

            if(empty($idGrupo)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            if(!$this->hayAlgunModulo($modulosPost)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Debes seleccionar al menos un módulo en alguna franja horaria';
                return [
                    'mensaje' => $this->mensaje,
                    'volver'  => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=altaHorarioModulos&id='.$idGrupo,
                ];
            }

            $profesorM = new Profesor();
            $moduloM = new Modulo();
            $horaM = new Hora();

            $horas = $horaM->todas();

            $celdas = [];

            foreach($modulosPost as $dia => $porHora){
                foreach($porHora as $idHora => $idModulo){
                    if (empty($idModulo)) continue;

                    $modulo = $moduloM->obtener($idModulo);
                    $profesores = $profesorM->porModuloGrupo($idModulo, $idGrupo);

                    $celdas[$dia][$idHora] = [
                        'modulo' => $modulo,
                        'profesores' => $profesores,
                    ];
                }
            }

            $g = new Grupo();

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_altaHorarioPro.php';

            return [
                'idGrupo' => $idGrupo,
                'grupo' => $g->obtener($idGrupo),
                'horas' => $horas,
                'celdas' => $celdas,
                'dias' => ['L','M','X','J','V'],
            ];
        }

        public function verHorario(){

            $id = $_GET['id'] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $g = new Grupo();
            $h = new Horario();
            $horaM = new Hora();
            
            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_verHorario.php';

            return [
                'grupo' => $g->obtener($id),
                'horas' => $horaM->todas(),
                'horario' => $h->porGrupo($id),
                'dias' => ['L','M','X','J','V']
            ];

        }

        private function mensajeDuplicado($mensajeError){
            if(preg_match("/Duplicate entry '([^']+)' for key 'csu_horario_profesor'/", $mensajeError, $coincidencias)){
                $partes = explode('-', $coincidencias[1]);
                if(count($partes) == 3){
                    $dia = $partes[0];
                    $idHora = $partes[1];
                    $idProfesor = $partes[2];

                    $nombresDias = ['L' => 'Lunes', 'M' => 'Martes', 'X' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes'];
                    $nombreDia = $nombresDias[$dia] ?? $dia;

                    $horaM = new Hora();
                    $profesorM = new Profesor();

                    $hora = $horaM->obtener($idHora);
                    $profesor = $profesorM->obtener($idProfesor);

                    return $profesor['nombre'].' ya tiene clase el '.$nombreDia.' de '.$hora['hora'];
                }
            }

            return 'Ese profesor ya tiene clase en esa franja horaria. Cambia la selección.';
        }

        public function guardarHorario(){

            $idGrupo = $_POST['idGrupo'] ?? null;
            $modulosPost = $_POST['mod'] ?? [];
            $profPost = $_POST['prof'] ?? [];

            if(empty($idGrupo)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $h = new Horario();
            $mensaje = 'Horario guardado correctamente';
            $ok = true;
            $codigoError = 0;

            $h->empezarTransaccion();

            $res = $h->borrarPorGrupo($idGrupo);
            if(!$res['ok']){
                $h->deshacerTransaccion();
                $ok = false;
                $codigoError = $res['codigo'];
                $mensaje = 'Error al borrar el horario anterior: '.$res['error'];
            }

            if($ok){
                foreach($modulosPost as $dia => $porHora){
                    foreach($porHora as $idHora => $idModulo){

                        if(empty($idModulo)) continue;

                        $idProfesor = $profPost[$dia][$idHora] ?? null;

                        if(empty($idProfesor)){
                            $h->deshacerTransaccion();
                            $ok = false;
                            $mensaje = "Día $dia hora $idHora: módulo sin profesor";
                            break 2;
                        }

                        $h->setDia($dia);
                        $h->setIdGrupo($idGrupo);
                        $h->setIdModulo($idModulo);
                        $h->setIdProfesor($idProfesor);
                        $h->setIdHora($idHora);

                        $res = $h->anadir();

                        if(!$res['ok']){
                            $h->deshacerTransaccion();
                            $ok = false;
                            $codigoError = $res['codigo'];

                            if($res['codigo'] == 1062){
                                $mensaje = $this->mensajeDuplicado($res['error']);
                            }else{
                                $mensaje = 'Error BD: '.$res['error'];
                            }
                            break 2;
                        }
                    }
                }
            }

            if($ok){
                $h->confirmarTransaccion();
            }

            // Si es duplicado, volver a la pantalla de profesores con los mismos módulos
            if(!$ok && $codigoError == 1062){
                $profesorM = new Profesor();
                $moduloM = new Modulo();
                $horaM = new Hora();

                $celdas = [];
                foreach($modulosPost as $dia => $porHora){
                    foreach($porHora as $idHora => $idModulo){
                        if(empty($idModulo)) continue;

                        $celdas[$dia][$idHora] = [
                            'modulo' => $moduloM->obtener($idModulo),
                            'profesores' => $profesorM->porModuloGrupo($idModulo, $idGrupo),
                        ];
                    }
                }

                $g = new Grupo();
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_altaHorarioPro.php';
                $this->mensaje = $mensaje;

                return [
                    'idGrupo' => $idGrupo,
                    'grupo' => $g->obtener($idGrupo),
                    'horas' => $horaM->todas(),
                    'celdas' => $celdas,
                    'dias' => ['L','M','X','J','V'],
                    'mensaje' => $this->mensaje,
                    'ok' => false,
                ];
            }

            $g = new Grupo();
            $horaM = new Hora();

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_verHorario.php';

            return [
                'grupo' => $g->obtener($idGrupo),
                'horas' => $horaM->todas(),
                'horario' => $h->porGrupo($idGrupo),
                'dias' => ['L','M','X','J','V'],
                'mensaje' => $mensaje,
                'ok' => $ok,
            ];
        }

        public function confirmarBorrarHorarioGrupo(){

            $id = $_GET['id'] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $g = new Grupo();
            $grupo = $g->obtener($id);

            if($grupo === null){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Grupo no encontrado';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_confirmar.php';

            return [
                'mensaje' => '¿Seguro que quieres eliminar el horario del grupo <strong>'.$grupo['codigo'].' - '.$grupo['nombre'].'</strong>?',
                'urlSi' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=borrarHorarioGrupo&id='.$id,
                'urlNo' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
            ];
        }

        public function borrarHorarioGrupo(){

            $id = $_GET['id'] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el grupo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $g = new Grupo();
            $res = $g->borrarHorarioPorGrupo($id);

            if(!$res['ok']){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Error al borrar el horario: '.$res['error'];
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_horario&metodo=listarGrupos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_listarGrupos.php';

            return [
                'grupos' => $g->todas(),
                'g' => $g,
            ];
        }

    }

?>