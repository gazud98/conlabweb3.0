<?php

class Cookie_helper{

    protected $_enable_xss = FALSE;

	function set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL){
		$this->setcookie($name, $value, $expire, $domain, $path, $prefix, $secure, $httponly);
	}

	function get_cookie($index, $xss_clean = NULL){
		return $this->cookie($index, $xss_clean);
	}

	function delete_cookie($name, $domain = '', $path = '/'){
		$this->setcookie($name, '', '', $domain, $path);
	}

    function cookie($index = NULL, $xss_clean = NULL){
		return $this->_fetch_from_array($_COOKIE, $index, $xss_clean);
	}

    public function setcookie($name, $value='', $expire='', $domain='', $path='/', $prefix='', $secure=NULL, $httponly=NULL){

		if (is_array($name)){
			// always leave 'name' in last place, as the loop will break otherwise, due to $$item
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'httponly', 'name') as $item){
				if (isset($name[$item])){
					$$item = $name[$item];
				}
			}
		}

		if ( ! is_numeric($expire)){ $expire = time() - 86500;
		}else{ $expire = ($expire > 0) ? time() + $expire : 0; }

		setcookie($name, $value, $expire, $path, $domain, $secure, $httponly,'/; samesite=none');
	}

    protected function _fetch_from_array(&$array, $index = NULL, $xss_clean = NULL){

		is_bool($xss_clean) OR $xss_clean = $this->_enable_xss;
		// If $index is NULL, it means that the whole $array is requested
		isset($index) OR $index = array_keys($array);
		// allow fetching multiple keys at once
		if (is_array($index)){
			$output = array();
			foreach ($index as $key){
				$output[$key] = $this->_fetch_from_array($array, $key, $xss_clean);
			}
			return $output;
		}

		if (isset($array[$index])){
			$value = $array[$index];
		}elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1){
			$value = $array;
			for ($i = 0; $i < $count; $i++){
				$key = trim($matches[0][$i], '[]');
				if ($key === ''){ break; }
				if (isset($value[$key])){ $value = $value[$key]; }
				else{ return NULL; }
			}
		}else{ return NULL; }
		return $value;
	}

}
