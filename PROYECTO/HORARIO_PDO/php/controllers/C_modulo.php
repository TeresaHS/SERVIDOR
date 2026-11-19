<?php

    require_once RUTA_TRABAJO.RUTA_MODELO.'Conexion.php';
    require_once RUTA_TRABAJO.RUTA_MODELO.'Modulo.php';

    class C_modulo{

        public $vista;
        public $mensaje;

        public function __construct($vista=null, $mensaje=null){
            $this->vista=$vista;
            $this->mensaje=$mensaje;
        }

        private function validarModulo($codigo, $nombre) {
            $errores = [];

            // ctype_digit() comprueba que todos los caracteres son dígitos 0-9 (no acepta +, -, ., e, espacios)
            if($codigo === '' || !ctype_digit($codigo) || strlen($codigo) !== 4) $errores[] = 'El código es obligatorio, debe ser numérico de 4 dígitos';

            if(trim($nombre) === '') $errores[] = 'El nombre es obligatorio';

            return $errores;
        }

        public function listarModulos(){

            $m = new Modulo();

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_listarModulos.php';

            return [
                'modulos' => $m->todas()
            ];
        }

        public function pedirDatosModulo(){
            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_pedirDatosModulo.php';
            return [];
        }

        public function altaModulo(){

            $codigo = trim($_POST['codigo'] ?? '');
            $nombre = trim($_POST['nombre'] ?? '');

            $errores = $this->validarModulo($codigo, $nombre);

            if(!empty($errores)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = implode('<br>', $errores);
                return [
                    'mensaje' => $this->mensaje,
                    'volver'  => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=pedirDatosModulo',
                ];
            }

            $m = new Modulo();

            $m->setCodigo($codigo);
            $m->setNombre($nombre);

            $resultado = $m->anadir();

            if(!$resultado['ok']){

                if($resultado['codigo'] == 1062){
                    $this->mensaje = 'Ya existe un módulo con ese código';
                }else{
                    $this->mensaje = 'Error al añadir: '.$resultado['error'];
                }

                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                return [
                    'mensaje' => $this->mensaje,
                    'volver'  => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=pedirDatosModulo',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_altaModulo.php';
            $this->mensaje = 'Módulo añadido correctamente';

            return [
                'ok' => true
            ];
        }

        public function traerModulo(){

            $id = $_GET['id'] ?? null;

            $m = new Modulo();

            $resultado = $m->obtener($id);

            if($resultado === null){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Módulo no encontrado';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_traerModulo.php';

            return [
                'id' => $resultado['id'],
                'codigo' => $resultado['codigo'],
                'nombre' => $resultado['nombre']
            ];
        }

        public function verModulo(){

            $id = $_GET['id'] ?? null;

            $m = new Modulo();

            $resultado = $m->obtener($id);

            if($resultado === null){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Módulo no encontrado';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_verModulo.php';

            return [
                'id' => $resultado['id'],
                'codigo' => $resultado['codigo'],
                'nombre' => $resultado['nombre']
            ];
        }

        public function bajaModulo(){

            $id = $_GET['id'] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el módulo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $m = new Modulo();

            if($m->estaEnHorario($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'No se puede eliminar el módulo porque está asignado en un horario';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $m->setId($id);
            $resultado = $m->eliminar();

            if(!$resultado['ok']){

                if($resultado['codigo'] == 1451){
                    $this->mensaje = 'No se puede eliminar el módulo porque está referenciado en otra tabla';
                }else{
                    $this->mensaje = 'Error al eliminar: '.$resultado['error'];
                }

                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_listarModulos.php';

            return [
                'modulos' => $m->todas(),
            ];
        }

        public function confirmarBajaModulo(){

            $id = $_GET['id'] ?? null;

            if(empty($id)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Falta el módulo';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $m = new Modulo();
            $modulo = $m->obtener($id);

            if($modulo === null){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = 'Módulo no encontrado';
                return [
                    'mensaje' => $this->mensaje,
                    'volver' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_confirmar.php';

            return [
                'mensaje' => '¿Seguro que quieres eliminar el módulo <strong>'.$modulo['codigo'].' - '.$modulo['nombre'].'</strong>?',
                'urlSi' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=bajaModulo&id='.$id,
                'urlNo' => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=listarModulos',
            ];
        }
        
        public function modificarModulo(){

            $id = $_GET['id'] ?? null;
            $codigo = trim($_POST['codigo'] ?? '');
            $nombre = trim($_POST['nombre'] ?? '');

            $errores = $this->validarModulo($codigo, $nombre);

            if(!empty($errores)){
                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                $this->mensaje = implode('<br>', $errores);
                return [
                    'mensaje' => $this->mensaje,
                    'volver'  => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=traerModulo&id='.$id,
                ];
            }

            $m = new Modulo($id, $codigo, $nombre);

            $resultado = $m->modificar();

            if(!$resultado['ok']){

                if($resultado['codigo'] == 1062){
                    $this->mensaje = 'Ya existe un módulo con ese código';
                }else{
                    $this->mensaje = 'Error al modificar: '.$resultado['error'];
                }

                $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_error.php';
                return [
                    'mensaje' => $this->mensaje,
                    'volver'  => RUTA_TRABAJO.'index.php?controlador=C_modulo&metodo=traerModulo&id='.$id,
                ];
            }

            $this->vista = RUTA_TRABAJO.RUTA_VISTA.'v_modificarModulo.php';
            $this->mensaje = 'Módulo modificado correctamente';

            return [
                'ok' => true
            ];
        }

    }

?>