<?php

require_once 'core/platform/Security.php';

class Input extends Security{

	protected $ip_address = FALSE;
	protected $_allow_get_array = TRUE;
	protected $_standardize_newlines;
	protected $_enable_xss = FALSE;
	protected $_enable_csrf = FALSE;
	protected $headers = array();
	protected $_raw_input_stream;
	protected $_input_stream;
	protected $security;
	protected $uni;

	public function is_ajax_request(){

		return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
	}

	protected function _fetch_from_array(&$array, $index = NULL, $xss_clean = NULL){

		is_bool($xss_clean) OR $xss_clean = $this->_enable_xss;

		// If $index is NULL, it means that the whole $array is requested
		isset($index) OR $index = array_keys($array);

		// allow fetching multiple keys at once
		if (is_array($index))
		{
			$output = array();
			foreach ($index as $key)
			{
				$output[$key] = $this->_fetch_from_array($array, $key, $xss_clean);
			}

			return $output;
		}

		if (isset($array[$index]))
		{
			$value = $array[$index];
		}
		elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) // Does the index contain array notation
		{
			$value = $array;
			for ($i = 0; $i < $count; $i++)
			{
				$key = trim($matches[0][$i], '[]');
				if ($key === '') // Empty notation will return the value as array
				{
					break;
				}

				if (isset($value[$key]))
				{
					$value = $value[$key];
				}
				else
				{
					return NULL;
				}
			}
		}
		else
		{
			return NULL;
		}

		return ($xss_clean === TRUE)
			? parent::xss_clean($value)
			: $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from the GET array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_GET
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function get($index = NULL, $xss_clean = NULL){

		return $this->_fetch_from_array($_GET, $index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from the POST array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_POST
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function post($index = NULL, $xss_clean = NULL){

		return $this->_fetch_from_array($_POST, $index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from POST data with fallback to GET
	 *
	 * @param	string	$index		Index for item to be fetched from $_POST or $_GET
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function post_get($index, $xss_clean = NULL){

		return isset($_POST[$index])
			? $this->post($index, $xss_clean)
			: $this->get($index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from GET data with fallback to POST
	 *
	 * @param	string	$index		Index for item to be fetched from $_GET or $_POST
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function get_post($index, $xss_clean = NULL){
		
		return isset($_GET[$index])
			? $this->get($index, $xss_clean)
			: $this->post($index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from the COOKIE array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_COOKIE
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function cookie($index = NULL, $xss_clean = NULL){

		return $this->_fetch_from_array($_COOKIE, $index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from the SERVER array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_SERVER
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function server($index, $xss_clean = NULL){

		return $this->_fetch_from_array($_SERVER, $index, $xss_clean);
	}

	// ------------------------------------------------------------------------

	/**
	 * Fetch an item from the php://input stream
	 *
	 * Useful when you need to access PUT, DELETE or PATCH request data.
	 *
	 * @param	string	$index		Index for item to be fetched
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function input_stream($index = NULL, $xss_clean = NULL){

		// Prior to PHP 5.6, the input stream can only be read once,
		// so we'll need to check if we have already done that first.
		if ( ! is_array($this->_input_stream))
		{
			// $this->raw_input_stream will trigger __get().
			parse_str($this->raw_input_stream, $this->_input_stream);
			is_array($this->_input_stream) OR $this->_input_stream = array();
		}

		return $this->_fetch_from_array($this->_input_stream, $index, $xss_clean);
	}

	// ------------------------------------------------------------------------

	/**
	 * Set cookie
	 *
	 * Accepts an arbitrary number of parameters (up to 7) or an associative
	 * array in the first parameter containing all the values.
	 *
	 * @param	string|mixed[]	$name		Cookie name or an array containing parameters
	 * @param	string		$value		Cookie value
	 * @param	int		$expire		Cookie expiration time in seconds
	 * @param	string		$domain		Cookie domain (e.g.: '.yourdomain.com')
	 * @param	string		$path		Cookie path (default: '/')
	 * @param	string		$prefix		Cookie name prefix
	 * @param	bool		$secure		Whether to only transfer cookies via SSL
	 * @param	bool		$httponly	Whether to only makes the cookie accessible via HTTP (no javascript)
	 * @return	void
	 */
	public function set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL){

		if (is_array($name))
		{
			// always leave 'name' in last place, as the loop will break otherwise, due to $$item
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'httponly', 'name') as $item)
			{
				if (isset($name[$item]))
				{
					$$item = $name[$item];
				}
			}
		}

		if ($prefix === '' && cookie_prefix !== '')
		{
			$prefix = cookie_prefix;
		}

		if ($domain == '' && cookie_domain != '')
		{
			$domain = cookie_domain;
		}

		if ($path === '/' && cookie_path !== '/')
		{
			$path = cookie_path;
		}

		$secure = ($secure === NULL && cookie_secure !== NULL)
			? (bool) cookie_secure
			: (bool) $secure;

		$httponly = ($httponly === NULL && cookie_httponly !== NULL)
			? (bool) cookie_httponly
			: (bool) $httponly;

		if ( ! is_numeric($expire))
		{
			$expire = time() - 86500;
		}
		else
		{
			$expire = ($expire > 0) ? time() + $expire : 0;
		}

		setcookie($prefix.$name, $value, $expire, $path, $domain, $secure, $httponly);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the IP Address
	 *
	 * Determines and validates the visitor's IP address.
	 *
	 * @return	string	IP address
	 */
	public function ip_address(){

		if ($this->ip_address !== FALSE){

			return $this->ip_address;
		}

		$proxy_ips = proxy_ips;
		if ( ! empty($proxy_ips) && ! is_array($proxy_ips))
		{
			$proxy_ips = explode(',', str_replace(' ', '', $proxy_ips));
		}

		$this->ip_address = $this->server('REMOTE_ADDR');

		if ($proxy_ips)
		{
			foreach (array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'HTTP_X_CLIENT_IP', 'HTTP_X_CLUSTER_CLIENT_IP') as $header)
			{
				if (($spoof = $this->server($header)) !== NULL)
				{
					// Some proxies typically list the whole chain of IP
					// addresses through which the client has reached us.
					// e.g. client_ip, proxy_ip1, proxy_ip2, etc.
					sscanf($spoof, '%[^,]', $spoof);

					if ( ! $this->valid_ip($spoof))
					{
						$spoof = NULL;
					}
					else
					{
						break;
					}
				}
			}

			if ($spoof)
			{
				for ($i = 0, $c = count($proxy_ips); $i < $c; $i++)
				{
					// Check if we have an IP address or a subnet
					if (strpos($proxy_ips[$i], '/') === FALSE)
					{
						// An IP address (and not a subnet) is specified.
						// We can compare right away.
						if ($proxy_ips[$i] === $this->ip_address)
						{
							$this->ip_address = $spoof;
							break;
						}

						continue;
					}

					// We have a subnet ... now the heavy lifting begins
					isset($separator) OR $separator = $this->valid_ip($this->ip_address, 'ipv6') ? ':' : '.';

					// If the proxy entry doesn't match the IP protocol - skip it
					if (strpos($proxy_ips[$i], $separator) === FALSE)
					{
						continue;
					}

					// Convert the REMOTE_ADDR IP address to binary, if needed
					if ( ! isset($ip, $sprintf))
					{
						if ($separator === ':')
						{
							// Make sure we're have the "full" IPv6 format
							$ip = explode(':',
								str_replace('::',
									str_repeat(':', 9 - substr_count($this->ip_address, ':')),
									$this->ip_address
								)
							);

							for ($j = 0; $j < 8; $j++)
							{
								$ip[$j] = intval($ip[$j], 16);
							}

							$sprintf = '%016b%016b%016b%016b%016b%016b%016b%016b';
						}
						else
						{
							$ip = explode('.', $this->ip_address);
							$sprintf = '%08b%08b%08b%08b';
						}

						$ip = vsprintf($sprintf, $ip);
					}

					// Split the netmask length off the network address
					sscanf($proxy_ips[$i], '%[^/]/%d', $netaddr, $masklen);

					// Again, an IPv6 address is most likely in a compressed form
					if ($separator === ':')
					{
						$netaddr = explode(':', str_replace('::', str_repeat(':', 9 - substr_count($netaddr, ':')), $netaddr));
						for ($j = 0; $j < 8; $j++)
						{
							$netaddr[$j] = intval($netaddr[$j], 16);
						}
					}
					else
					{
						$netaddr = explode('.', $netaddr);
					}

					// Convert to binary and finally compare
					if (strncmp($ip, vsprintf($sprintf, $netaddr), $masklen) === 0)
					{
						$this->ip_address = $spoof;
						break;
					}
				}
			}
		}

		if ( ! $this->valid_ip($this->ip_address))
		{
			return $this->ip_address = '0.0.0.0';
		}

		return $this->ip_address;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate IP Address
	 *
	 * @param	string	$ip	IP address
	 * @param	string	$which	IP protocol: 'ipv4' or 'ipv6'
	 * @return	bool
	 */
	public function valid_ip($ip, $which = ''){

		switch (strtolower($which))
		{
			case 'ipv4':
				$which = FILTER_FLAG_IPV4;
				break;
			case 'ipv6':
				$which = FILTER_FLAG_IPV6;
				break;
			default:
				$which = NULL;
				break;
		}

		return (bool) filter_var($ip, FILTER_VALIDATE_IP, $which);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch User Agent string
	 *
	 * @return	string|null	User Agent string or NULL if it doesn't exist
	 */
	public function user_agent($xss_clean = NULL){

		return $this->_fetch_from_array($_SERVER, 'HTTP_USER_AGENT', $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Sanitize Globals
	 *
	 * Internal method serving for the following purposes:
	 *
	 *	- Unsets $_GET data, if query strings are not enabled
	 *	- Cleans POST, COOKIE and SERVER data
	 * 	- Standardizes newline characters to PHP_EOL
	 *
	 * @return	void
	 */
	protected function _sanitize_globals()
	{
		// Is $_GET data allowed? If not we'll set the $_GET to an empty array
		if ($this->_allow_get_array === FALSE)
		{
			$_GET = array();
		}
		elseif (is_array($_GET))
		{
			foreach ($_GET as $key => $val)
			{
				$_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
		}

		// Clean $_POST Data
		if (is_array($_POST))
		{
			foreach ($_POST as $key => $val)
			{
				$_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
		}

		// Clean $_COOKIE Data
		if (is_array($_COOKIE))
		{
			// Also get rid of specially treated cookies that might be set by a server
			// or silly application, that are of no use to a CI application anyway
			// but that when present will trip our 'Disallowed Key Characters' alarm
			// http://www.ietf.org/rfc/rfc2109.txt
			// note that the key names below are single quoted strings, and are not PHP variables
			unset(
				$_COOKIE['$Version'],
				$_COOKIE['$Path'],
				$_COOKIE['$Domain']
			);

			foreach ($_COOKIE as $key => $val)
			{
				if (($cookie_key = $this->_clean_input_keys($key)) !== FALSE)
				{
					$_COOKIE[$cookie_key] = $this->_clean_input_data($val);
				}
				else
				{
					unset($_COOKIE[$key]);
				}
			}
		}

		// Sanitize PHP_SELF
		$_SERVER['PHP_SELF'] = strip_tags($_SERVER['PHP_SELF']);

		trigger_error('debug', 'Global POST, GET and COOKIE data sanitized');
	}

	// --------------------------------------------------------------------

	/**
	 * Clean Input Data
	 *
	 * Internal method that aids in escaping data and
	 * standardizing newline characters to PHP_EOL.
	 *
	 * @param	string|string[]	$str	Input string(s)
	 * @return	string
	 */
	protected function _clean_input_data($str)
	{
		if (is_array($str))
		{
			$new_array = array();
			foreach (array_keys($str) as $key)
			{
				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($str[$key]);
			}
			return $new_array;
		}

		/* We strip slashes if magic quotes is on to keep things consistent

		   NOTE: In PHP 5.4 get_magic_quotes_gpc() will always return 0 and
		         it will probably not exist in future versions at all.
		*/
		if (!$this->is_php('5.4')){
			
			$str = stripslashes($str);
		}

		// Clean UTF-8 if supported
		if (UTF8_ENABLED === TRUE){

			$str = $this->uni->clean_string($str);
		}

		// Remove control characters
		$str = $this->remove_invisible_characters($str, FALSE);

		// Standardize newlines if needed
		if ($this->_standardize_newlines === TRUE)
		{
			return preg_replace('/(?:\r\n|[\r\n])/', PHP_EOL, $str);
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Clean Keys
	 *
	 * Internal method that helps to prevent malicious users
	 * from trying to exploit keys we make sure that keys are
	 * only named with alpha-numeric text and a few other items.
	 *
	 * @param	string	$str	Input string
	 * @param	bool	$fatal	Whether to terminate script exection
	 *				or to return FALSE if an invalid
	 *				key is encountered
	 * @return	string|bool
	 */
	protected function _clean_input_keys($str, $fatal = TRUE){

		if ( ! preg_match('/^[a-z0-9:_\/|-]+$/i', $str)){

			if ($fatal === TRUE){
				return FALSE;
			}else{
				$this->set_status_header(503);
				echo 'Disallowed Key Characters.';
				exit(7); // EXIT_USER_INPUT
			}
		}

		// Clean UTF-8 if supported
		if (UTF8_ENABLED === TRUE)
		{
			return $this->uni->clean_string($str);
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Request Headers
	 *
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	array
	 */
	public function request_headers($xss_clean = FALSE)
	{
		// If header is already defined, return it immediately
		if ( ! empty($this->headers))
		{
			return $this->_fetch_from_array($this->headers, NULL, $xss_clean);
		}

		// In Apache, you can simply call apache_request_headers()
		if (function_exists('apache_request_headers'))
		{
			$this->headers = apache_request_headers();
		}
		else
		{
			isset($_SERVER['CONTENT_TYPE']) && $this->headers['Content-Type'] = $_SERVER['CONTENT_TYPE'];

			foreach ($_SERVER as $key => $val)
			{
				if (sscanf($key, 'HTTP_%s', $header) === 1)
				{
					// take SOME_HEADER and turn it into Some-Header
					$header = str_replace('_', ' ', strtolower($header));
					$header = str_replace(' ', '-', ucwords($header));

					$this->headers[$header] = $_SERVER[$key];
				}
			}
		}

		return $this->_fetch_from_array($this->headers, NULL, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Get Request Header
	 *
	 * Returns the value of a single member of the headers class member
	 *
	 * @param	string		$index		Header name
	 * @param	bool		$xss_clean	Whether to apply XSS filtering
	 * @return	string|null	The requested header on success or NULL on failure
	 */
	public function get_request_header($index, $xss_clean = FALSE)
	{
		static $headers;

		if ( ! isset($headers))
		{
			empty($this->headers) && $this->request_headers();
			foreach ($this->headers as $key => $value)
			{
				$headers[strtolower($key)] = $value;
			}
		}

		$index = strtolower($index);

		if ( ! isset($headers[$index]))
		{
			return NULL;
		}

		return ($xss_clean === TRUE)
			? parent::xss_clean($headers[$index])
			: $headers[$index];
	}



	// --------------------------------------------------------------------

	/**
	 * Is CLI request?
	 *
	 * Test to see if a request was made from the command line.
	 *
	 * @deprecated	3.0.0	Use is_cli() instead
	 * @return	bool
	 */
	public function is_cli_request(){

		return $this->is_cli();

	}

	// --------------------------------------------------------------------

	/**
	 * Get Request Method
	 *
	 * Return the request method
	 *
	 * @param	bool	$upper	Whether to return in upper or lower case
	 *				(default: FALSE)
	 * @return 	string
	 */
	public function method($upper = FALSE)
	{
		return ($upper)
			? strtoupper($this->server('REQUEST_METHOD'))
			: strtolower($this->server('REQUEST_METHOD'));
	}

	// ------------------------------------------------------------------------

	/**
	 * Magic __get()
	 *
	 * Allows read access to protected properties
	 *
	 * @param	string	$name
	 * @return	mixed
	 */
	public function __get($name){

		if ($name === 'raw_input_stream')
		{
			isset($this->_raw_input_stream) OR $this->_raw_input_stream = file_get_contents('php://input');
			return $this->_raw_input_stream;
		}
		elseif ($name === 'ip_address')
		{
			return $this->ip_address;
		}
	}


	public function is_php($version){

		static $_is_php;
		$version = (string) $version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
		}

		return $_is_php[$version];
	}

	public function remove_invisible_characters($str, $url_encoded = TRUE){

		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/i';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/i';	// url encoded 16-31
			$non_displayables[] = '/%7f/i';	// url encoded 127
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}

	function is_cli(){

		return (PHP_SAPI === 'cli' OR defined('STDIN'));

	}


	function set_status_header($code = 200, $text = ''){

		if ($this->is_cli()){ return; }

		if (empty($code) OR ! is_numeric($code)){ trigger_error('Status codes must be numeric', 500); }

		if (empty($text)){

			is_int($code) OR $code = (int) $code;
			$stati = array(
				100	=> 'Continue',
				101	=> 'Switching Protocols',

				200	=> 'OK',
				201	=> 'Created',
				202	=> 'Accepted',
				203	=> 'Non-Authoritative Information',
				204	=> 'No Content',
				205	=> 'Reset Content',
				206	=> 'Partial Content',

				300	=> 'Multiple Choices',
				301	=> 'Moved Permanently',
				302	=> 'Found',
				303	=> 'See Other',
				304	=> 'Not Modified',
				305	=> 'Use Proxy',
				307	=> 'Temporary Redirect',

				400	=> 'Bad Request',
				401	=> 'Unauthorized',
				402	=> 'Payment Required',
				403	=> 'Forbidden',
				404	=> 'Not Found',
				405	=> 'Method Not Allowed',
				406	=> 'Not Acceptable',
				407	=> 'Proxy Authentication Required',
				408	=> 'Request Timeout',
				409	=> 'Conflict',
				410	=> 'Gone',
				411	=> 'Length Required',
				412	=> 'Precondition Failed',
				413	=> 'Request Entity Too Large',
				414	=> 'Request-URI Too Long',
				415	=> 'Unsupported Media Type',
				416	=> 'Requested Range Not Satisfiable',
				417	=> 'Expectation Failed',
				422	=> 'Unprocessable Entity',
				426	=> 'Upgrade Required',
				428	=> 'Precondition Required',
				429	=> 'Too Many Requests',
				431	=> 'Request Header Fields Too Large',

				500	=> 'Internal Server Error',
				501	=> 'Not Implemented',
				502	=> 'Bad Gateway',
				503	=> 'Service Unavailable',
				504	=> 'Gateway Timeout',
				505	=> 'HTTP Version Not Supported',
				511	=> 'Network Authentication Required',
			);

			if (isset($stati[$code])){
				$text = $stati[$code];
			}else{	trigger_error('No status text available. Please check your status code number or supply your own message text.', 500);	}
		}

		if (strpos(PHP_SAPI, 'cgi') === 0){

			header('Status: '.$code.' '.$text, TRUE);
			return;
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE))
			? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		header($server_protocol.' '.$code.' '.$text, TRUE, $code);
	}

}
