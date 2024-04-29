<?php

    class ControladorBase{
        
        public $form_validation;
        public $input;
        public $security;
        public $auth;
        public $datatable;


        protected static $_instances = array(); 

        //Instances aux
        private static $instance_model;
        private static $instance_core;
        private static $instance_helper;
        private static $instance_library;

        public function __construct() {
            $this->input           = ControladorBase::Input();
            $this->security        = ControladorBase::Security();
        }

        public function __destruct(){

            unset(self::$_instances[array_search($this, self::$_instances, true)]);

        }

        public static function __callStatic($name, $args) {

            foreach(glob("core/libraries/*.php") as $libraries){ require_once $libraries; } 

            if (!in_array($name, array_keys(self::$_instances))) {
                //then we must make a new instance
                //check if we have arguments
                //for the constructor    
                if (!empty($args)) {
                    //then we need reflection to instantiate
                    //with an arbitrary number of args
                    $rc = new ReflectionClass($name);
                    $instance = $rc->newInstanceArgs($args);
                } else {
                    //then we do not need reflection,
                    //since the new keyword will accept a string in a variable
                    $instance = new $name();
                }
                //and finally add it to the list
                self::$_instances [$name] = $instance;
            }else{
                //then we already have one
                $instance = self::$_instances[$name];
            }
            
            return $instance;
        }
        
        public function view($vista,$datos = array()){
            //procesador de vistas del sistemas
            foreach ($datos as $id_assoc => $valor) { ${$id_assoc} = $valor; }           
            require_once 'view/'.$vista.'View.php';

        }

        public function redirect($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO){
            //redirección o busqueda de controlador y función epecifica.
            header("Location:index.php?c=".$controlador."&a=".$accion);
        }

        public function url($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO){
            $urlString = "index.php?c=".$controlador."&a=".$accion;
            return $urlString;
        }


        public static function model($clase){
            foreach(glob("model/*.php") as $model){ require_once $model; }    
            if (self::$instance_model === null){ return self::$instance_model = new $clase(); }  
            return self::$instance_model;
        }

        public static function core($clase){
            require_once 'core/system/'.$clase.'.php';
            $clase = $clase; 
            if (self::$instance_core === null){ return self::$instance_core = new $clase(); }  
            return self::$instance_core;
        }

        public static function helpers($clase){
            require_once 'core/helpers/'.$clase.'.php';
            $clase = $clase; 
            if (self::$instance_helper === null){ return self::$instance_helper = new $clase(); }  
            return self::$instance_helper;
        }

        public static function library($data){

            require_once 'libraries/'.$clase.'.php';
            $clase = $clase.'_lib'; 
            if (self::$instance_library === null){return self::$instance_library = new $clase(); }  
            return self::$instance_library;

        }

    }
