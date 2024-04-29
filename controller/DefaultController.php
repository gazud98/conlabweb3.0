<?php
class DefaultController extends ControladorBase{

    public function __construct(){
        parent::__construct();
        $this->auth = ControladorBase::auth_lib();
    }

    public function index(){
        //funcion de ejemplo
        if (!$this->auth->is_logged_in()) { $this->redirect("Auth", "index");
        }elseif($this->auth->is_logged_in(FALSE)) { $this->redirect("Auth", "send_again"); // logged in, not activated
        }else{ $this->view("private/pages/Default"); }
    }

    public function mantenimiento_consumos(){

        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            
            $data['sedes'] = $this->auth->get_sedes(); //reemplazar por sedes user, para usuario multisede.
            $this->view("private/pages/mantenimiento_consumos", $data);
        }
    }

   
} //fin clase UsuariosController ?> 