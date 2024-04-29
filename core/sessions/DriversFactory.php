<?php


class DriversFactory{
    /** @var array Associa los nombre de las dos formas de usar class session */
    private static $drivers = array(
        Session::FILES_DRIVER => '\session\Drivers\Files',
        Session::DATABASE_DRIVER => '\session\Drivers\Database',
    );

    /**
     * Returns a new driver instance.
     *
     * @param string $driver Driver name to instantiate; if doesn't exist, Files driver will be used
     * @param array $config Processed array of settings
     *
     * @return BaseSessionDriver Instance of built driver
     */
    public function build($driver, array $config){

        if (is_string(self::$drivers[$driver])) {
            require_once 'Drivers/'.$driver.'.php';
        }
 
        return self::$drivers[$driver];
    }

    /**
     * Register a new driver
     *
     * @param string $name Driver name
     * @param string|BaseSessionDriver $class Class name or instance of a driver
     * @return bool Whether the registering succeeded or not
     */
    public static function registerDriver($name, $class){
        
        if (is_subclass_of($class, '\sessions\BaseSessionDriver')) {
            self::$drivers[$name] = $class;
            return true;
        }

        return false;
    }
}
