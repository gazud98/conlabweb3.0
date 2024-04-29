<?php
    
    require_once './config/database_config.php';
    require_once './core/database/InstanceFactoryDB.php';

    class ModeloBase extends InstanceFactoryDB{
        
        public $conexioPDO;
        public $conectar;
        public $datatable;

        public function __construct() {
            $this->conectar   = InstanceFactoryDB::getInstance(CONEXIONDBACCESS);
            $this->conexioPDO = $this->conectar->conexioPDO();
        }

    } //fin class ModeloBase
    
?>
