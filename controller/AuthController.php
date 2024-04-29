<?php
class AuthController extends ControladorBase{   

    public function __construct() {
        parent::__construct();

        $this->form_validation = ControladorBase::form_validation_lib();
        $this->auth            = ControladorBase::auth_lib();

    }

    public function index(){


        if($this->auth->is_logged_in()){ $this->redirect('App');
        }elseif($this->auth->is_logged_in(FALSE)){ $this->redirect('auth','send_again');
        }else{ $this->redirect('auth','login'); }

    }
    
    function login(){
        
        if($this->auth->is_logged_in()) {
            $this->redirect('app','index');
        }elseif($this->auth->is_logged_in(FALSE)) {	
            $this->redirect('auth','send_again');
        }else{
            if($this->input->post('login') and login_count_attempts){
                $login = $this->input->post('login'); 
            }else{ $login = '';  }

            $data['login'] = $login;
            $data['login_by_username'] = (login_by_username AND use_username);
            $data['login_by_email'] =   login_by_email;
            $data['show_captcha'] = FALSE;
            $data['use_recaptcha'] = use_recaptcha;

            if ($this->auth->is_max_login_attempts_exceeded_by_ip()) {
                $data['show_captcha'] = TRUE;
               if ($data['use_recaptcha']){ $data['recaptcha_html'] = ''; }} //$this->_create_recaptcha()

            $data['empresa'] = 'Información de la empresa';
            $this->view("public/templates/head");
            $this->view("public/templates/body", $data);
                $this->view("public/scripts/auth_js");
            $this->view("public/templates/footer");
       }
    }


    function login_singin(){

	    if(!$this->input->is_ajax_request()){
		    $data['message'] =  'No se puede Iniciar sessión';
	    }else{
		    if ($this->auth->is_logged_in()){ // logged in
			    $data['logged_in'] = TRUE;
		    }elseif($this->auth->is_logged_in(FALSE)){ // logged in, not activated
			    $data['logged_in'] = FALSE;
		    }else{
                $data['logged_in']         = NULL;
                $data['errors']            = array();
                $data['error_string']      = array();
                $data['inputerror']        = array();
                $data['login_by_username'] = ((login_by_username) AND (use_username));
                $data['login_by_email']    = login_by_email;
                $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('remember', 'Remember me', 'integer');
                // Get login for counting attempts to login
                if ((login_count_attempts==TRUE) AND ($login = $this->input->post('login'))){ 
                    $login = $this->security->xss_clean($login);
                }else{	$login = ''; }
                $data['use_recaptcha'] = use_recaptcha;
                $data['show_captcha']  = FALSE;
                if ($this->auth->is_max_login_attempts_exceeded($login)) {
                    $data['show_captcha'] = TRUE;
                    if ($data['use_recaptcha']){ $data['recaptcha_html'] = ''; }
                }
		    	$this->form_validation->set_error_delimiters('', '');

		        if ($this->form_validation->run()){ // validation ok
				    if ($this->auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {	
					
                        $count = array(); //$this->auth->count_profile($this->auth->get_id_users());

						//configurar usuarios multiperfiles

                        //inicializar arreglo de navegación
                        //$_SESSION["navigation"] = array(TRUE);
                        $_SESSION['navigation'][0] = array( 'name'       => 'GENERICO',
                                            'url'        => base_url,
                                            'status'     => 1,
                                            'icono'      => 'fa fa-check',
                                            'id'         => 0,
                                            'submodules' => FALSE );
                                            
                    	$data['status'] = TRUE;
                    }else{
                        $errors = $this->auth->get_error_message();
                        if(isset($errors['banned'])){
                            $data['banned'][]  = 'El usuario se encuentra Inactivo';
                        }else if (isset($errors['not_activated'])){// not activated user
                            $this->redirect('/auth/send_again/');
                        }else{// fail                      
                            foreach ($errors as $k => $v){	
                            $data['inputerror'][] =   $k;
                            $data['error_string'][] = LANG[$v];
                            $data['status'] = FALSE;
                            }	 	
                        }
                    }

				}else{

			    	     $data['inputerror'][] =   'login';
                         $data['error_string'][] = $this->form_validation->error('login');
                         $data['status'] = FALSE;
                         $data['inputerror'][] = 'password';
                         $data['error_string'][] = $this->form_validation->error('password');
                         $data['status'] = FALSE;
                         $data['inputerror'][] = 'remember';
                         $data['error_string'][] = $this->form_validation->error('remember');
                         $data['status'] = FALSE;
		        }
	        } 
	    } echo json_encode($data); 
	}

    public function logout(){ 
        $this->auth->logout();
        header('Location:'.base_url);
    }


} //fin clase UsuariosController ?> 