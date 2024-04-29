<?php

abstract class BaseSessionDriver implements SessionHandlerInterface{

    protected $config;
	protected $_fingerprint;
    protected $_lock = FALSE;
    protected $initialSessionId;
    private static $trueValue, $falseValue;

    public function __construct(array $config){
        
        $this->config = $config;
        self::$trueValue = TRUE;
        self::$falseValue = FALSE;

    }

    public function php5_validate_id(){
		if (isset($_COOKIE[$this->config['cookie_name']]) && !$this->validateSessionId($_COOKIE[$this->config['cookie_name']])){
			unset($_COOKIE[$this->config['cookie_name']]);
		}
	}

    protected function destroyCookie(){

        return @setcookie(
            $this->config['cookie_name'],
            null,
            1,
            $this->config['cookie_path'],
            $this->config['cookie_domain'],
            $this->config['cookie_secure'],
            true
        );
    }

    protected function getIp(){ return $_SERVER['REMOTE_ADDR']; }

    protected static function true(){ return self::$trueValue; }

    protected static function false(){ return self::$falseValue; }

    protected function _get_lock($initialSessionId){	$this->_lock = TRUE; return TRUE;}

	protected function _release_lock(){ if ($this->_lock){ $this->_lock = FALSE; }	return TRUE; }

}
