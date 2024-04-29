<?php

require_once 'Conectar.php';

class InstanceFactoryDB{

    private static $DB;
    private static $DB2;

    public static function getInstance(array $config = null){ 
        if (self::$DB === null){  return self::$DB = new Conectar($config); }
        return self::$DB;
    }

    public static function getInstancetwo(array $config = null){ 
        if (self::$DB2 === null) {  return self::$DB2 = new Conectar($config);  }
        return self::$DB2;
    }
  
}
