<?php

    require_once "ConectarPDO.php";
 
    class Conectar{

        private $driver;
        private $user, $pass, $database, $charset;
    
        public function __construct($config) { 
            
            $this->driver   = $config['driver']; 
            $this->user     = $config['user'];
            $this->pass     = $config['pass'];
            $this->database = $config['database'];
            $this->charset  = $config['charset'];   

        }

        public function conexioPDO(){

            if($this->driver == "mysql" || $this->driver == null){

                try { $pdo    = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
                      $conpdo = new ConectarPDO($pdo);
                      return $conpdo; }
                catch( PDOException $e){ throw new Exception("[".$e->getCode()."] : ". $e->getMessage());  }

            }
        }
        
    } //fin de la clase conectaar 
