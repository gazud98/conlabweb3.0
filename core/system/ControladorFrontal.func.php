<?php
    //FUNCIONES PARA EL CONTROLADOR FRONTAL
    function cargarControlador($controller){

        $controlador = ucwords($controller).'Controller';
        $strFileController = 'controller/'.$controlador.'.php';
        
        if(!is_file($strFileController)){
            $strFileController = 'controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';
            $controlador = ucwords(CONTROLADOR_DEFECTO).'Controller'; 
            require_once $strFileController;
            $controllerObj = new $controlador();
            return $controllerObj;
        }else{
            require_once $strFileController;
            $controllerObj = new $controlador();
            return $controllerObj;
        }

    }

    function lanzarAccion($controllerObj){
        //busqueda de la acción a ejecutar y empalmada con el controlador 
        if(isset($_GET["a"]) && method_exists($controllerObj, $_GET["a"])){
               cargarAccion($controllerObj, $_GET["a"]);
        }else{ cargarAccion($controllerObj, ACCION_DEFECTO); }
    } 

    function cargarAccion($controllerObj,$action){  $accion = $action;  $controllerObj->$accion(); }

    function cargarCookiedb($token){
        
        require_once './core/database/Conectar.php'; 
        $conectar    = new Conectar(CONEXIONDBCW);
        $conexioPDO  = $conectar->conexioPDO();
        $query       = $conexioPDO->get_row('enterprise', array('token'=> md5($token)));;
        if(!empty($query)){ return $query['prefix']; }else{ return PREFIX_DEFAULT; }

    }

    if (!function_exists('load_class')) {

        function &load_class($class, $directory = 'platform', $param = NULL){

            static $_classes = array();
            // Does the class exist? If so, we're done...
            if (isset($_classes[$class])) {   return $_classes[$class]; }

            $name = FALSE;
            // Look for the class first in the local application/libraries folder
            // then in the native system/libraries folder
            if (file_exists('./core/'.$directory . '/' . $class . '.php')) {
                $name = $class;
                if (class_exists($name, FALSE) === FALSE) { require_once('./core/'.$directory . '/' . $class . '.php'); }
            }


            // Is the request a class extension? If so we load it too
            if (file_exists('./core/'.$directory . '/' . $class . '.php')) {
                $name = $class;

                if (class_exists($name, FALSE) === FALSE) {
                    require_once('./core/'. $directory . '/' . $name . '.php');
                }
            }

            // Did we find the class?
            if ($name === FALSE) {
                // Note: We use exit() rather than show_error() in order to avoid a
                // self-referencing loop with the Exceptions class
                echo 'Unable to locate the specified class: ' . $class . '.php';
                exit; // EXIT_UNK_CLASS
            }

            // Keep track of what we just loaded
            is_loaded($class);

            $_classes[$class] = isset($param)
                ? new $name($param)
                : new $name();
            return $_classes[$class];
        }
    }


    if( ! function_exists('is_loaded')) {
        /**
         * Keeps track of which libraries have been loaded. This function is
         * called by the load_class() function above
         *
         * @param	string
         * @return	array
         */
        function &is_loaded($class = ''){
            static $_is_loaded = array();
            if ($class !== ''){   $_is_loaded[strtolower($class)] = $class; }
            return $_is_loaded;
        }
    }

?>
