<?php 

/**
 * Auth_lib
 * Authentication library
 *
 * @package		Auth_lib
 * @author		Jesús Ariza (http://jesusarizareyes@gmail.com/)
 * @version		1.0
 */

require_once './config/session_config.php';   

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');
	
class Auth_lib extends ControladorBase{

	public $error = array();

	function __construct(){
		parent::__construct(); 
		$this->session    = SessionFactory::getInstance(CONFIGSESSION);
		$this->usermodel  = $this->model('UsersModel');
		$this->cookie     = $this->helpers('Cookie_helper');
	}

	/**
	 * Login user on the site. Return TRUE if login is successful
	 * (user exists and activated, password is correct), otherwise FALSE.
	 *
	 * @param	string	(username or email or both depending on settings in config file)
	 * @param	string
	 * @param	bool
	 * @return	bool
	**/  

	function login($login, $password, $remember, $login_by_username, $login_by_email){

		if ((strlen($login) > 0) AND (strlen($password) > 0)) {
			// Which function to use to login (based on config)
			if($login_by_username AND $login_by_email){	$get_user_func = 'get_user_by_login';
			}else if($login_by_username){               $get_user_func = 'get_user_by_username';
			}else{                                      $get_user_func = 'get_user_by_email';}

			if (!is_null($user = $this->usermodel->$get_user_func($login))){// login ok
				// Does pass
				if (password_verify($password, $user['password'])) {// password ok
					if($user['ban_reason'] == 1) { // fail - banned
						$this->error = array('banned' => $user['ban_reason']);
					}else{

						$this->session->setUserdata(array(
								'id_users'	 => $user['id_users'],
								'username'	 => $user['username'],
								'sede'	     => $user['sede_default'],
								'status'	 => ($user['activated'] == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
						));

    					if($user['activated']==0){
							// fail - not activated
							$this->error = array('not_activated' => '');
						}else{
							// success
							if ($remember){ $this->create_autologin($user['id_users']); }
							$this->clear_login_attempts($login);
							$this->usermodel->update_login_info(
									$user['id_users'],
									login_record_ip,
									login_record_time);
							return TRUE;
						}
					}
				}else{ // fail - wrong password
					$this->increase_login_attempt($login);
					$this->error = array('password' => 'auth_incorrect_password');
				}
			}else{	
				// fail - wrong login
				$this->increase_login_attempt($login);
				$this->error = array('login' => 'auth_incorrect_login');
			}
		}
		return FALSE;
	}

	/**
	 * Logout user from the site
	 *
	 * @return	void
	 */
	function logout(){
		$this->delete_autologin();
		$this->session->setUserdata(array('id_users' => '', 'username' => '', 'proname' => '', 'status' => '', 'id_profiles' => '', 'sede' => ''));
		$this->session->destroy();
	}

	/**
	 * Check if user logged in. Also test if user is activated or not.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_logged_in($activated = TRUE){
		return $this->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
	}
	
		
	/**
	 * Get role name from role_id
	 *
	 * @param	string
	 * @param	integer
	 */
	 
	
	function get_id_users(){ return $this->session->userdata('id_users'); }

	function add_profile($data){ return $this->usermodel->add_profile($data); }

	function count_profile($id_users){  return $this->usermodel->count_profile($id_users); }

	function get_profiles($id_users){ return $this->usermodel->get_profiles($id_users); }

	function list_profiles(){ return $this->usermodel->list_profiles(); }

	function get_profiles_not_default($id_users){ return $this->usermodel->get_profiles_not_default($id_users); }

	function get_profiles_not_created($id_users, $id_profile){ 
		return $this->usermodel->get_profiles_not_created($id_users, $id_profile);
	}

	function get_username(){ return $this->session->userdata('username'); }

	function get_profile(){	return $this->session->userdata('proname'); }

	function get_user_profiles(){
		return $this->usermodel->get_user_profiles( $this->session->userdata('id_profiles'),
			                                        $this->session->userdata('id_users'));
	}

	function get_id_profiles(){	return $this->session->userdata('id_profiles'); }

    function get_profile_name($id_profiles=''){
		if($id_profiles){ return $this->usermodel->get_profile($id_profiles); }
	}

	function verify_profiles($id_profiles, $proname){
		return $this->usermodel->verify_profiles($id_profiles, 
		                                         $proname,
											     $this->session->userdata('id_users'));
	}

	function get_sede_default(){ return $this->session->userdata('sede'); }

	function get_name_sede_default(){
		return $this->usermodel->get_sede_by_id($this->session->userdata('sede'))['name'];
	}

	//Comprobación del perfil
	function is_profile($name=''){
		if($name){ if($this->session->userdata('proname') == $name){ return TRUE; } }
	}

	function update_profile_default_autologin($id_profiles){
       if ($this->usermodel->update_profile_default_0($this->session->userdata('id_users'))) {
       	    return $this->usermodel->update_profile_default_autologin($id_profiles,
			                                                          $this->session->userdata('id_users'));
       }
	}

	function create_user($username, $email, $password, $email_activation){
		if ((strlen($username) > 0) AND !$this->usermodel->is_username_available($username)) {
			$this->error = array('username' => 'auth_username_in_use');
		}elseif(!$this->usermodel->is_email_available($email)) {
			$this->error = array('email' => 'auth_email_in_use');
		}else{
			// Hash password using phpass
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$data = array(
				'username'	  => $username,
				'password'	  => $hashed_password,
				'email'		  => $email,
				'last_ip'	  => ip_address,
				'id_personal' => NUll
			);

			if ($email_activation) {
				$data['new_email_key'] = md5(rand().microtime());
			}

			if (!is_null($res = $this->usermodel->create_userpro($data, !$email_activation))) {
				$data['id_users'] = $res['id_users'];
				$data['password'] = $hashed_password;
				unset($data['last_ip']);
				return $data;
				return true;
			}
		}
		return NULL;
	}
	
	function update_userpro($username, $email, $password, $activated, $id_users){
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$data = array(
				'username'	=> $username,
				'password'	=> $hashed_password,
				'email'		=> $email,
				'last_ip'	=> ip_address,
			);
			if (!is_null($this->usermodel->update_userpro($data, $activated, $id_users))) {
				return TRUE;}
			return NULL;
	}


	function update_userpro_email($email, $activated, $id_users){

		$data = array( 'email' => $email, 'last_ip'	=> ip_address);
		if (!is_null($this->usermodel->update_userpro($data, $activated, $id_users))){ return TRUE; }
		return NULL;

	}

	function update_userpro_username($username, $activated, $id_users){

		$data = array( 'username'  => $username, 'last_ip'	=> ip_address );
		if (!is_null($this->usermodel->update_userpro($data, $activated, $id_users))){ return TRUE; }
		return NULL;
	}
		
	function is_username_available($username){
		return ((strlen($username) > 0) AND $this->usermodel->is_username_available($username));
	}

	function is_email_available($email){
		return ((strlen($email) > 0) AND $this->usermodel->is_email_available($email));
	}

	function change_email($email){

		$id_users = $this->session->userdata('id_users');
		if (!is_null($user = $this->usermodel->get_user_by_id($id_users, FALSE))) {
			$data = array(
				'id_users'	=> $id_users,
				'username'	=> $user->username,
				'email'		=> $email,
			);
			if (strtolower($user->email) == strtolower($email)) {		// leave activation key as is
				$data['new_email_key'] = $user->new_email_key;
				return $data;
			}elseif($this->usermodel->is_email_available($email)) {
				$data['new_email_key'] = md5(rand().microtime());
				$this->usermodel->set_new_email($id_users, $email, $data['new_email_key'], FALSE);
				return $data;
			}else{ $this->error = array('email' => 'auth_email_in_use'); }
		}

		return NULL;
	}

	function activate_user($id_users, $activation_key, $activate_by_email = TRUE){

		$this->usermodel->purge_na(email_activation_expire);

		if ((strlen($id_users) > 0) AND (strlen($activation_key) > 0)) {
			return $this->usermodel->activate_user($id_users, $activation_key, $activate_by_email);
		}
		return FALSE;
	}

	function forgot_password($login){
		if (strlen($login) > 0) {
			if (!is_null($user = $this->usermodel->get_user_by_login($login))) {
				$data = array(
					'id_users'		=> $user->id_users,
					'username'		=> $user->username,
					'email'			=> $user->email,
					'new_pass_key'	=> md5(rand().microtime()),
				);
				$this->usermodel->set_password_key($user->id_users, $data['new_pass_key']);
				return $data;
			} else { $this->error = array('login' => 'auth_incorrect_email_or_username'); }
		}
		return NULL;
	}

	function can_reset_password($id_users, $new_pass_key){

		if ((strlen($id_users) > 0) AND (strlen($new_pass_key) > 0)) {
			return $this->usermodel->can_reset_password(
				$id_users,
				$new_pass_key,
				forgot_password_expire);
		}else{	return FALSE; }
	}

	function reset_password($id_users, $new_pass_key, $new_password){

		if ((strlen($id_users) > 0) AND (strlen($new_pass_key) > 0) AND (strlen($new_password) > 0)) {
			if (!is_null($user = $this->usermodel->get_user_by_id($id_users, TRUE))) {

				$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
				if ($this->usermodel->reset_password(
						$id_users,
						$hashed_password,
						$new_pass_key,
						forgot_password_expire)) {	// success

					// Clear all user's autologins
					$this->usermodel->user_autologin_clear($user->id_users);

					return array(
						'id_users'		=> $id_users,
						'username'		=> $user->username,
						'email'			=> $user->email,
						'new_password'	=> $new_password,
					);

				}
			}

		}else{

			return NULL;
		}
		
	}


	function change_username($password, $new_username){

		$id_users = $this->session->userdata('id_users');

		if (!is_null($user = $this->usermodel->get_user_by_id($id_users, TRUE))) {
			// Check if old password correct
			if (password_verify($password, $user->password)) {			// success
				// Replace old password with new one
				$this->usermodel->change_username($id_users, $new_username);
				return TRUE;
			} else {	
			    // fail
				$this->error = array('password' => 'auth_incorrect_password');

			}
		}
		return FALSE;
	} 


	function change_username_search($id_users, $new_username){
       
        $this->usermodel->change_username($id_users, $new_username);

		return TRUE;

	}

	/**
	 * Change user password (only when user is logged in)
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function change_password($old_pass, $new_pass){

		$id_users = $this->session->userdata('id_users');

		if (!is_null($user = $this->usermodel->get_user_by_id($id_users, TRUE))) {

			// Check if old password correct
			if (password_verify($old_pass, $user->password)) {			// success

				// Hash new password using phpass
				$hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

				// Replace old password with new one
				$this->usermodel->change_password($id_users, $hashed_password);
				return TRUE;

			} else {															// fail
				$this->error = array('old_password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	//cambio de contraseña sin verificacion de la anterior

	function change_password_search($id_users, $new_pass){

			// Check if old password correct

				// Hash new password using phpass
				$hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

				// Replace old password with new one
				$this->usermodel->change_password($id_users, $hashed_password);
				return TRUE;


	}

	/**
	 * Change user email (only when user is logged in) and return some data about user:
	 * id_users, username, new_email, new_email_key.
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function set_new_email($new_email, $password){

		$id_users = $this->session->userdata('id_users');

		if (!is_null($user = $this->usermodel->get_user_by_id($id_users, TRUE))) {

			// Check if password correct
			if (password_verify($password, $user->password)) {			// success

				$data = array(
					'id_users'	=> $id_users,
					'username'	=> $user->username,
					'new_email'	=> $new_email,
				);

				if ($user->email == $new_email) {
					$this->error = array('email' => 'auth_current_email');

				} elseif ($user->new_email == $new_email) {		// leave email key as is
					$data['new_email_key'] = $user->new_email_key;
					return $data;

				} elseif ($this->usermodel->is_email_available($new_email)) {
					$data['new_email_key'] = md5(rand().microtime());
					$this->usermodel->set_new_email($id_users, $new_email, $data['new_email_key'], TRUE);
					return $data;

				} else {
					$this->error = array('email' => 'auth_email_in_use');
				}
			} else {															// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return NULL;
	}

	/**
	 * Activate new email, if email activation key is valid.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($id_users, $new_email_key){

		if ((strlen($id_users) > 0) AND (strlen($new_email_key) > 0)) {
			return $this->usermodel->activate_new_email(
					$id_users,
					$new_email_key);
		}
		return FALSE;
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @param	string
	 * @return	bool
	 */
	function delete_user($password){

		$id_users = $this->session->userdata('id_users');

		if (!is_null($user = $this->usermodel->get_user_by_id($id_users, TRUE))) {

			// Check if password correct
			if (password_verify($password, $user->password)){// success
				$this->usermodel->delete_user($id_users);
				$this->logout();
				return TRUE;
			}else{// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as login or register.
	 *
	 * @return	string
	 */

	function get_error_message(){ return $this->error; }
    
	/**
	 * Save data for user's autologin
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_autologin($id_users){
		$key    = substr(md5(uniqid(rand().$this->cookie->get_cookie(autologin_cookie_name))), 0, 16);
		$this->usermodel->user_autologin_purge($id_users);
		if ($this->usermodel->user_autologin_set($id_users, md5($key))) {
			$this->cookie->set_cookie(array('name' 		=> autologin_cookie_name,
											'value'		=> serialize(array('id_users' => $id_users, 'key' => $key)),
											'expire'	=> autologin_cookie_life));
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Clear user's autologin data
	 *
	 * @return	void
	 */
	private function delete_autologin(){
		if ($cookie = $this->cookie->get_cookie(autologin_cookie_name, TRUE)){
			$data = unserialize($cookie);
			$this->usermodel->user_autologin_delete($data['id_users'], md5($data['key']));
			$this->cookie->delete_cookie(autologin_cookie_name);
		}
	}

	/**
	 * Login user automatically if he/she provides correct autologin verification
	 *
	 * @return	void
	 */
	private function autologin(){
		if (!$this->is_logged_in() AND !$this->is_logged_in(FALSE)){// not logged in (as any user)
			if ($cookie = $this->cookie->get_cookie(autologin_cookie_name, TRUE)) {
				$data = unserialize($cookie);
				if (isset($data['key']) AND isset($data['id_users'])) {
					if (!is_null($user = $this->usermodel->user_autologin_get($data['id_users'], md5($data['key'])))) {
						// Login user
						$this->session->setUserdata(array(
								'id_users' 	 => $user->id_users,
								'username'   => $user->username,
								'proname'    => $this->get_profile_name($user->id_profiles),
								'id_profiles'=> $user->id_profiles,
								'status'	 => STATUS_ACTIVATED,
						));
						// Renew Users cookie to prevent it from expiring
						$this->cookie->set_cookie(array(
							'name' 		=> autologin_cookie_name,
							'value'		=> $cookie,
							'expire'	=> autologin_cookie_life,
					    ));
						$this->usermodel->update_login_info(
								$user->id_users,
								login_record_ip,
								login_record_time);
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * Check if login attempts exceeded max login attempts (specified in config)
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_max_login_attempts_exceeded($login){

		if (login_count_attempts) {
			return $this->usermodel->get_attempts_num(ip_address, $login)
					>= login_max_attempts;
		}
		return FALSE;
	}

	function is_max_login_attempts_exceeded_by_ip(){

		if (login_count_attempts) {
			return $this->usermodel->get_attempts_num(ip_address)>= login_max_attempts;
		}
		return FALSE;
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 * (if attempts to login is being counted)
	 *
	 * @param	string
	 * @return	void
	 */
	private function increase_login_attempt($login){

		if (login_count_attempts) {
			if (!$this->is_max_login_attempts_exceeded($login)) {
				$this->usermodel->increase_attempt(ip_address, $login);
			}
		}
	}

	private function clear_login_attempts($login){
		
		if (login_count_attempts) {
			$this->usermodel->clear_attempts(
					ip_address,
					$login,
					login_attempt_expire);
		}
	}


	//sistema de navegación por session

	public function start_navigation_module($name, $estado, $url, $id, $icono){

        $data   = array();

        if(is_array($_SESSION["navigation"])){
            $count_navigation = count($_SESSION["navigation"]);
            for ($i=0; $i < $count_navigation; $i++) { 
                if(!empty($name)){
                    if (is_array($_SESSION["navigation"][$i])) {
                        $search = array_search($name, array_values($_SESSION["navigation"][$i])); 
                        $_SESSION["navigation"][$i]['status'] = 0;                         
                        if ($search===FALSE){ $data[] = FALSE; }else{ $data[] = TRUE; }
                    }else{
                        $_SESSION['navigation'][$i] = array(  'name'       => $name,
                                                              'url'        => $url,//.ACCION_DEFECTO,
                                                              'status'     => 1,
                                                              'icono'      => $icono,
                                                              'id'         => $id,
                                                              'submodules' => FALSE );
                        $data[] = TRUE; 
                    }
                }
            }// fin for

            if(array_search(TRUE, array_values($data))===FALSE){

                array_push($_SESSION['navigation'], array(  'name'       => $name,
                                                            'url'        => $url,//.ACCION_DEFECTO,
                                                            'status'     => 1,
                                                            'icono'      => $icono,
                                                            'id'         => $id,
                                                            'submodules' => FALSE ));
            }
        }
	}



	public function star_navigation_submodules($name, $estado, $url, $id, $icono){

        $data   = array();

        if(is_array($_SESSION["navigation"])){
            $count_navigation = count($_SESSION["navigation"]); 
            for ($i=0; $i < $count_navigation; $i++) { 
                if (is_array($_SESSION["navigation"][$i])) {
                   $search = array_search($name, array_values($_SESSION["navigation"][$i])); 
                   if($search===FALSE){  $_SESSION["navigation"][$i]['status'] = 0;
                   }else{  $_SESSION["navigation"][$i]['status'] = 1; } 
                }
            }
        }

	}

	public function reset_status_modulos_home(){

		if(is_array($_SESSION["navigation"])){
            $count_navigation = count($_SESSION["navigation"]); 
            for ($i=0; $i < $count_navigation; $i++){ 
                if (is_array($_SESSION["navigation"][$i])){
                    $_SESSION["navigation"][$i]['status'] = 0;  
                }
            }
        }

        return TRUE;

	}


	public function get_menu_principal(){
 
		$menu  = '';
		$datos = array();
		$data  = $this->usermodel->get_modulos();
		
		if(!empty($_SESSION["navigation"])){
			if(is_array($_SESSION["navigation"])){
				$count_navigation = count($_SESSION["navigation"]);
				for ($i=0; $i < $count_navigation; $i++) { 
					if(is_array($_SESSION["navigation"][$i])){
						if($_SESSION["navigation"][$i]['status']==1){
							$datos[] = TRUE;
							$this->dashboard_modulo($_SESSION["navigation"][$i]['name']);
						}else{ $datos[] = FALSE; }

					}
				}
			}

			if(count(array_filter($datos))==0){
				if (isset($_SESSION["navigation"][0]['status'])) {
					$this->dashboard_principal();
				}else{
					$this->dashboard_principal();
				}
			}
		}
		echo $menu;
	}

	public function dashboard_principal(){
        
		$menu  = '';
		$data  = $this->usermodel->get_modulos();

		if(!empty($_SESSION["navigation"])){   

			$menus = $this->list_modules();
			$data  = $this->usermodel->get_modulos();
			$count = count($menus);
			if(!empty($menus)){
				for ($i=0; $i < $count; $i++) {
                    if($menus[$i]['estado']==1){ $estado = 'active'; }else{ $estado = ''; }
					echo   "<a  data-id     = '".$menus[$i]['id']."'
								data-name   = '".$menus[$i]['name']."'
								data-href   = '".$menus[$i]['url']."'
								data-icono  = '".$menus[$i]['icono']."'
								data-estado = '".$menus[$i]['estado']."'  
								class       = 'col-12 col-sm-6 col-md-3 ".$estado." nav-dash-act' 
								href        = 'javascript:void(0)'>
								<div class='info-box'>
									<span class='info-box-icon bg-danger elevation-1'>
										<i class='".$menus[$i]['icono']."'></i>
									</span>
									<div class='info-box-content'>
										<span class='info-box-text'>".$menus[$i]['name']."</span>
									</div>
									<!-- /.info-box-content -->
								</div>
					   	    </a>";
						if (!empty($data)) {
						foreach($data as $index => $dat) {
							if($dat['name'] == $menus[$i]['name']) unset($data[$index]);
						}
					}
				}

				if(!empty($data)){
					foreach ($data as $key) {
					    echo    "<a data-id     = '".$key['id_modulos']."'
									data-name   = '".$key['name']."'
									data-href   = '".$key['url']."'
									data-icono  = '".$key['icono']."'
									data-estado = '".$key['estado']."'
									href='javascript:void(0)' class='col-12 col-sm-6 col-md-3 nav-dash'>
											<div class='info-box'>
												<span class='info-box-icon bg-info elevation-1'>
													<i class='".$key['icono']."'></i>
												</span>
												<div class='info-box-content'>
													<span class='info-box-text'>".$key['name']."</span>
												</div>
												<!-- /.info-box-content -->
											</div>
								</a>";	
					}
				}
			
			}else{
				if(!empty($data)){
					foreach ($data as $key){
						$menu .=    "<a data-id     = '".$key['id_modulos']."'
										data-name   = '".$key['name']."'
										data-href   = '".$key['url']."'
										data-icono  = '".$key['icono']."'
										data-estado = '".$key['estado']."'
										href='javascript:void(0)' class='col-12 col-sm-6 col-md-3 nav-dash'>
												<div class='info-box'>
													<span class='info-box-icon bg-info elevation-1'>
														<i class='".$key['icono']."'></i>
													</span>
													<div class='info-box-content'>
														<span class='info-box-text'>".$key['name']."</span>
													</div>
													<!-- /.info-box-content -->
												</div>
									</a>";
					}
				}
			}

			echo $menu;
		}
	}


	public function dashboard_modulo($name=null){ echo '<p class="display-4">DASHBOARD DEL MÓDULO ESPECIFICO '.strtoupper($name).'</p>'; }


	public function menu_total_right(){

		if(!empty($_SESSION["navigation"])){   //verifica que el menú de navegación halla sido inicializado

			$menus   = $this->list_modules(); //Listas de modulos ya inicializados por session, valor incial vacio
			$count   = count($menus); //cuenta el número de menús ya inicializados en sessión
			$data    = $this->usermodel->get_modulos(); //lista de odulos creados desde la base de datos
			$estado  = ''; //valor usuado como atributo para definir el estado de los botones 
			$color   = 'bg-danger';

			if(!empty($menus)){ //verifica que la lista de menús que se vienen se session no sean vacias

				for ($i=0; $i < $count; $i++){ 
					$estado = $menus[$i]['estado'] == 1 ?  'active':  ''; //define el estado resaltado del menú que se encuentra actualmente  
					if($menus[$i]['id'] == 0){ //corresponde al id del valor del menú dinamico
						if($menus[$i]['estado'] == 1 ){ //menú dinamico ACTIVO 
							$estado = 'checked = "checked"';
							$color  = 'bg-success';
						    unset($data); //Se elimina el valor de los modulos traidos desde la base de datos usados en la otra mnodalidad ded navegación
						}
					}else{	
						// se encarga de crear los menús de navegación especificos 
						echo    "<li class='nav-item'>
									<a  data-id     = '".$menus[$i]['id']."'
										data-name   = '".$menus[$i]['name']."'
										data-href   = '".$menus[$i]['url']."'
										data-icono  = '".$menus[$i]['icono']."'
										data-estado = '".$menus[$i]['estado']."'  
										class       = 'btn btn-danger ".$estado." nav-link p-2 nav-dash-act' 
										href        = 'javascript:void(0)'>
										".$menus[$i]['name']."</a>
							    </li>";
					}
                    /*verifica que la lista de menús DB no venga vacia y verifica que el nombre del modulos de la base de datos ea igual al nombre de los menús 
					  que ya se encuentran inicializdos y los elimina de la lista para no tener duplicidad de modulos en el menú principal*/
					if (!empty($data)){ foreach($data as $index => $dat){ if($dat['name'] == $menus[$i]['name']) unset($data[$index]); } }	
				} //fin for

				if(!empty($data)){ 
					// verifica que la lista de modulos DB no sean vacias y muestran los menus que no se encuentran en uso actualmente
					foreach ($data as $key) {
					    echo    "<li class='nav-item'>
									<a data-id  = '".$key['id_modulos']."'
									data-name   = '".$key['name']."'
									data-href   = '".$key['url']."'
									data-icono  = '".$key['icono']."'
									data-estado = '".$key['estado']."'
									href='javascript:void(0)' class='col-12 col-sm-6 col-md-3 nav-dash nav-link'>
									".$key['name']."</a>
							    </li>";	
					}
				}

			}else{ //define el valor inicial al momento de iniciar session con el total de modulos de la DB

                if(!empty($data)){
					foreach ($data as $key) {
						echo	"<li class='nav-item'>
										<a data-id  = '".$key['id_modulos']."'
										data-name   = '".$key['name']."'
										data-href   = '".$key['url']."'
										data-icono  = '".$key['icono']."'
										data-estado = '".$key['estado']."'
										href='javascript:void(0)' class='col-12 col-sm-6 col-md-3 nav-dash nav-link'>
										".$key['name']."</a>
								</li>";
					}
				}
			}

			$this->menu_dynamic($estado, $color); //su valor depende del proceso anterior que define el estado del menú dinamico.
		}
    }

	public function menu_dynamic($var1 = null, $var2 = null){

		echo '<ul class="todo-list ui-sortable" data-widget="todo-list" style="position: absolute;
		bottom: 5px;">
				<li class="">
					<!-- checkbox -->
					<div class="icheck-primary d-inline ml-2">
					<input type="checkbox" value="1" id="mdynamic" '.$var1.'>
					<label for="mdynamic"></label>
					</div>
					<!-- todo text -->
					<span class="text">Menú Dinámico</span>
					<!-- Emphasis label -->
					<small class="badge '.$var2.'"><i class="fa fa-bars"></i></small>
					<!-- General tools such as edit or delete-->
				</li>
			 </ul>';

	}


	public function list_modules(){
	   
		$menu = array();
		if(is_array($_SESSION["navigation"])){
			$count_navigation = count($_SESSION["navigation"]);
			for ($i=0; $i < $count_navigation; $i++) { 
				if(is_array($_SESSION["navigation"][$i])){
				 $menu[]      = array('modulo'     => $i, 
									  'id'         => $_SESSION["navigation"][$i]['id'], 
									  'name'       => $_SESSION["navigation"][$i]['name'], 
									  'estado'     => $_SESSION["navigation"][$i]['status'],
									  'url'        => $_SESSION["navigation"][$i]['url'],
									  'icono'      => $_SESSION["navigation"][$i]['icono'],
									  'submodules' => is_array($_SESSION["navigation"][$i]['submodules']) 
									 );
									  
				}
			}   
		} return $menu;
	}


	public function sub_menu_navigation(){
        
		if(!empty($_SESSION["navigation"])){
			if(is_array($_SESSION["navigation"])){
				$count_navigation = count($_SESSION["navigation"]);
				for ($i=0; $i < $count_navigation; $i++) { 
					if (is_array($_SESSION["navigation"][$i])){
						if ($_SESSION["navigation"][$i]['status']==1) {
							if($_SESSION["navigation"][$i]['id']==0){
								$query = $this->usermodel->get_modulos();
								if(!empty($query)){
									foreach ($query as $key => $index) {
										$data = $this->usermodel->get_submodulos_by_id_modulo($index['id_modulos']);
										echo '<li class="nav-item">
													<a href="#" class="nav-link">
														<i class="nav-icon fas fa-tree"></i>
														<p>'.$index['name'].'
															<i class="fas fa-angle-left right"></i>
														</p>
													</a>						            
													<ul class="nav nav-treeview" style="display:none">';
													if(!empty($data)){
														foreach ($data as $keys => $submodulo) {
															echo '<li class="nav-item">
																	<a href="'.$submodulo['url'].'" class="nav-link">
																		<i class="'.$submodulo['icono'].'"></i>
																		<p>'.$submodulo['name'].'</p>
																	</a>
																</li>';	
														}
													}
										echo '</ul></li>';
									}
								}
							}else{
								$data = $this->usermodel->get_submodulos_by_id_modulo($_SESSION["navigation"][$i]['id']);
								if(!empty($data)){
									foreach ($data as $key => $index) { 
										echo   "<li class='nav-item'>
													<a data-id  = '".$index['id_submodulos']."'
													data-name   = '".$index['name']."'
													data-href   = '".$index['url']."'
													data-icono  = '".$index['icono']."'
													data-estado = '".$index['estado']."'
													href='".$index['url']."' class='nav-link'>
														<i class='nav-icon  ".$index['icono']."'> </i>
														<p>".$index['name']."</p>
													</a> 
												</li>";
									}          
								}
							}
						}
					}
				}
			}  
		}  
    }


	public function submenu_tab(){
	  
		if(!empty($_GET["id"])){
			$modulo  = $_GET["id"];
			$submenu =  array();//$this->list_submodules_by_module($modulo);
			$count   = count($submenu);
			if(!empty($submenu)){
				for ($i=0; $i < $count; $i++) {
					echo '<li class="nav-item active" role="presentation">
								<a href="#" class="btn-iframe-close" data-widget="iframe-close" data-type="only-this">
									<i class="fas fa-times"></i>
								</a>
								<a class="nav-link active nav-tabsubmenu" data-toggle="row" id="tab--c-recepcion-a-buscar_usuario" href="#panel--c-recepcion-a-buscar_usuario" role="tab" aria-controls="panel--c-recepcion-a-buscar_usuario" aria-selected="true">
								'.$submenu[$i]['name'].'
								</a>
						 </li>';
	
				}
			}
			
		}else{ return FALSE; }
	
	}
    
	//group_modulos

	public function get_submodulos_by_identificacion($id){
    
		return $this->usermodel->get_submodulos_by_identificacion($id);
	}

	public function get_group_modulos_by_id($id){

		return $this->usermodel->get_group_modulos_by_id($id);

	}

	public function get_grupo_campos_by_id_grupomodulos($id){

		return $this->usermodel->get_grupo_campos_by_id_grupomodulos($id);

	}

}

