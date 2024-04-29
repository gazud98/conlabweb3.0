<?php
class AppController extends ControladorBase{   

    public function __construct() {

        parent::__construct();
        $this->form_validation = ControladorBase::form_validation_lib();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        
    }

    public function index(){

        if (!$this->auth->is_logged_in()) {
			$this->redirect("Auth", "index");
		}elseif($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        }else{
            $this->view("iframe");
        }

    }

    function app(){
        
		if (!$this->auth->is_logged_in()) {
			$this->redirect("Auth", "index");
		}elseif($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        }else{
			switch ($this->auth->get_profile()) {
				//case "super": redirect('Super'); break;
                case "manager": $this->redirect("app", "index"); break;
                //case "regedit": redirect('Register'); break;
                //case "guest": redirect('Guest');  break;
                default:   $this->redirect("app", "index");
                //default:    $this->auth->logout();
                //$this->redirect('auth','index'); 
            }
		}
	}

    public function _home(){ !$this->input->is_ajax_request()? header("Location:".base_url): $this->auth->reset_status_modulos_home(); }              

    public function _navigation(){ 

        if(!$this->input->is_ajax_request()){ header("Location:".base_url); 
	    }else{  $name   = $this->input->POST('name');
                $estado = $this->input->POST('estado');
                $url    = $this->input->POST('url');
                $id     = $this->input->POST('id');
                $icono  = $this->input->POST('icono');

                $this->auth->start_navigation_module($name, $estado, $url, $id, $icono); 
        }
    
    }

    public function _subnavigation(){ 
        
        if(!$this->input->is_ajax_request()){ header("Location:".base_url);
	    }else{  $name   = $this->input->POST('name');
                $estado = $this->input->POST('estado');
                $url    = $this->input->POST('url');
                $id     = $this->input->POST('id');
                $icono  = $this->input->POST('icono');
        
                $this->auth->star_navigation_submodules($name, $estado, $url, $id, $icono); 
        }
    }

    public function generical_navigation(){  

		unset($_SESSION['navigation']);

        $_SESSION['navigation'][0] = array( 'name'       => 'GENERICO',
                                            'url'        => base_url,
                                            'status'     => 1,
                                            'icono'      => 'fa fa-check',
                                            'id'         => 0,
                                            'submodules' => FALSE );
    }


    public function clear_navigation(){ $_SESSION['navigation'] = array(TRUE); }

    public function submenu_tab(){  $this->auth->submenu_tab(); }

    public function sub_menu_navigation(){  $this->auth->sub_menu_navigation(); }

    public function get_menu_principal(){   $this->auth->get_menu_principal(); }

    public function menu_total_right(){  $this->auth->menu_total_right(); }


    //CORE APLICATION

    public function mto_core()
    {
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'core';
            $name              = 'mto_core';
            $data['submodulo'] = $this->auth->get_submodulos_by_identificacion($name);
            $data['group']     = $this->auth->get_group_modulos_by_id($name);
            $this->view("private/pages/mto", $data);
        }
    }

    public function list_table(){

        $table = $this->input->GET('id');
        $data = $this->{'list_' . $table}($table);
        echo $this->_datatable($data);

    }

    private function _datatable($data){  echo $this->datatable->list_table($data); }

    public function ajax_modal(){

        $option = $this->input->POST('type');
        $table  = $this->input->POST('table');
        $data   = $this->{'list_' . $table}($table);
        $this->datatable->option_form($table, $data, $option, self::class);
    }

    public function ajax_add(){

        $table = $this->input->post('table');
        $data   = $this->{'list_' . $table}($table);
        $this->datatable->form_add($table, $data);
        
    }

    public function ajax_edit(){

        $table  = $this->input->post('table');
        $id     = $this->input->post('id');
        $data   = $this->{'list_' . $table}($table);
        $this->datatable->form_edit($table, $data, $id);

    }

    public function ajax_delete(){

        $table = $this->input->post('table');
        $id    = $this->input->post('id');
        $data  = $this->{'list_' . $table}($table);
        $dbdefault = ($data['dbdefault'] == 'desarrollo_access')? '': $data['dbdefault']; 
        $where = array('id_' . $table => $id);
        $this->datatable->ajax_delete($table, $where, $dbdefault); //dbdefault permite el cambio de bases de datos del sistema.
    }
    
    public function get_data(){ $this->datatable->get_data(); }

    private function list_modulos($table)
    {
        $data = array(
            'table'     => $table,
            'dbdefault' => 'desarrollo_access',
            'campos' => array(  array(
                                        'name'  => 'name',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'identificacion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'estado',
                                        'width' => '',
                                        'class' => 'btn btn-success',
                                        'join'  => FALSE,
                                        'type'  => 2, //describe el tipo de campo accion 1 , default, de estado ...
                                    )),
            'select' => FALSE,
            'search' => array('descripcion'),
            'accion' => array(
                                array(
                                    'objeto'     => 'buttom',
                                    'objetype'   => '', //for input
                                    'prop'       => '',
                                    'class'      => 'btn btn-info btn-sm',
                                    'title'      => 'Editar',
                                    'color'      => 'bg-info', //bg-danger - bg-warning - bg-primary -bg-dark - bg-info
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'edit',
                                    'icon'       => 'fa fa-edit',
                                    'vars'       => '{id},\'' . $table . '\''
                                ),

                                array(
                                    'objeto'     => 'buttom',
                                    'prop'       => '',
                                    'class'       => 'btn btn-danger btn-sm',
                                    'title'      => 'Eliminar',
                                    'color'      => '', //bg-danger - bg-warning - bg-primary -bg-dark 
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'eliminar',
                                    'icon'       => 'fa fa-danger',
                                    'vars'       => '{id},\'' . $table . '\''
            )),
            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Nuevo Módulos del sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'identificacion',
                                                    'title'     => 'Id del Módulo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),

                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'url',
                                                    'title'     => 'Url del Módulo',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'url',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                )
                                            ),
            ),
            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Módulos del Sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'identificacion',
                                                    'title'     => 'Id del Módulo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),

                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'url',
                                                    'title'     => 'Url del Módulo',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'url',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                ))),
        );
        return $data;
    }


    private function list_submodulos($table)
    {
        $data = array(
            'table'     => $table,
            'dbdefault' => 'desarrollo_access',
            'campos' => array(  array(
                                        'name'  => 'name',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'modulo',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'desarrollo_access.modulos as mo',
                                        'joinrelthis'  =>  $table.'.id_modulos',
                                        'joinrelchild' => 'mo.id_modulos',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                        'sqlconsult'   => '',
                                    ),
                                array(
                                        'name'  => 'identificacion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'icono',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'url',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                ),
                                array(
                                        'name'  => 'estado',
                                        'width' => '',
                                        'class' => 'btn btn-success',
                                        'join'  => FALSE,
                                        'type'  => 2, //describe el tipo de campo accion 1 , default, de estado ...
                                )),
            'select' => 'id_submodulos, mo.name modulo, '.$table.'.url, '.$table.'.identificacion, '.$table.'.name, '.$table.'.descripcion, '.$table.'.icono, '.$table.'.estado',
            'search' => array(),
            'accion' => array(
                                array(
                                    'objeto'     => 'buttom',
                                    'objetype'   => '', //for input
                                    'prop'       => '',
                                    'class'      => 'btn btn-info btn-sm',
                                    'title'      => 'Editar',
                                    'color'      => 'bg-info', //bg-danger - bg-warning - bg-primary -bg-dark - bg-info
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'edit',
                                    'icon'       => 'fa fa-edit',
                                    'vars'       => '{id},\'' . $table . '\''
                                ),

                                array(
                                    'objeto'     => 'buttom',
                                    'prop'       => '',
                                    'class'       => 'btn btn-danger btn-sm',
                                    'title'      => 'Eliminar',
                                    'color'      => '', //bg-danger - bg-warning - bg-primary -bg-dark 
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'eliminar',
                                    'icon'       => 'fa fa-danger',
                                    'vars'       => '{id},\'' . $table . '\''
            )),
            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Nuevo Módulos del sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_modulos',
                                                    'title'     => 'Modulos',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_modulos id, name  FROM modulos',
                                                    'colclass'  => 'col-lg-6',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),

                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'url',
                                                    'title'     => 'Url del Módulo',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'url',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                )
                                            ),
            ),
            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Módulos del Sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'identificacion',
                                                    'title'     => 'Id del Módulo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),

                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'url',
                                                    'title'     => 'Url del Módulo',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'url',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                ))),
        );
        return $data;
    }


    private function list_grupomodulos($table)
    {
        $data = array(
            'table'     => $table,
            'dbdefault' => 'desarrollo_access',
            'campos' => array(  array(
                                        'name'  => 'name',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'submodulo',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'desarrollo_access.submodulos as sub',
                                        'joinrelthis'  =>  $table.'.id_submodulos',
                                        'joinrelchild' => 'sub.id_submodulos',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                        'sqlconsult'   => '',
                                    ),
                                array(
                                        'name'  => 'identificacion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'estado',
                                        'width' => '',
                                        'class' => 'btn btn-success',
                                        'join'  => FALSE,
                                        'type'  => 2, //describe el tipo de campo accion 1 , default, de estado ...
                                    )),
            'select' => 'id_grupomodulos, sub.name submodulo, '.$table.'.url, '.$table.'.identificacion, '.$table.'.name, '.$table.'.descripcion, '.$table.'.icono, '.$table.'.estado',
            'search' => array(),
            'accion' => array(
                                array(
                                    'objeto'     => 'buttom',
                                    'objetype'   => '', //for input
                                    'prop'       => '',
                                    'class'      => 'btn btn-info btn-sm',
                                    'title'      => 'Editar',
                                    'color'      => 'bg-info', //bg-danger - bg-warning - bg-primary -bg-dark - bg-info
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'edit',
                                    'icon'       => 'fa fa-edit',
                                    'vars'       => '{id},\'' . $table . '\''
                                ),

                                array(
                                    'objeto'     => 'buttom',
                                    'prop'       => '',
                                    'class'       => 'btn btn-danger btn-sm',
                                    'title'      => 'Eliminar',
                                    'color'      => '', //bg-danger - bg-warning - bg-primary -bg-dark 
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'eliminar',
                                    'icon'       => 'fa fa-danger',
                                    'vars'       => '{id},\'' . $table . '\''
            )),
            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Nuevo Grupo de Submodulos del Sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_submodulos',
                                                    'title'     => 'Submodulos',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_submodulos id, name  FROM submodulos',
                                                    'colclass'  => 'col-lg-6',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'identificacion',
                                                    'title'     => 'Id del Módulo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                )
                                            ),
            ),
            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar grupo de submodulos del Sistema',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_submodulos',
                                                    'title'     => 'Submodulos',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_submodulos id, name  FROM submodulos',
                                                    'colclass'  => 'col-lg-6',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'identificacion',
                                                    'title'     => 'Id del Módulo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                ),
                                           )),
        );
        return $data;
    }


    private function list_grupo_campos($table)
    {
        $data = array(
            'table'     => $table,
            'dbdefault' => 'desarrollo_access',
            'campos' => array(  array(
                                        'name'  => 'name',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'grupo',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'desarrollo_access.grupomodulos as gr',
                                        'joinrelthis'  =>  $table.'.id_grupomodulos',
                                        'joinrelchild' => 'gr.id_grupomodulos',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                        'sqlconsult'   => '',
                                    ),
                                array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'width',
                                        'width' => '100',
                                        'class' => '',
                                        'join'  => FALSE,
                                    )),
            'select' => 'id_grupo_campos, '.$table.'.name, gr.name grupo,'.$table.'.descripcion, '.$table.'.width',
            'search' => array('descripcion'),
            'accion' => array(
                                array(
                                    'objeto'     => 'buttom',
                                    'objetype'   => '', //for input
                                    'prop'       => '',
                                    'class'      => 'btn btn-info btn-sm',
                                    'title'      => 'Editar',
                                    'color'      => 'bg-info', //bg-danger - bg-warning - bg-primary -bg-dark - bg-info
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'edit',
                                    'icon'       => 'fa fa-edit',
                                    'vars'       => '{id},\'' . $table . '\''
                                ),

                                array(
                                    'objeto'     => 'buttom',
                                    'prop'       => '',
                                    'class'       => 'btn btn-danger btn-sm',
                                    'title'      => 'Eliminar',
                                    'color'      => '', //bg-danger - bg-warning - bg-primary -bg-dark 
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'eliminar',
                                    'icon'       => 'fa fa-danger',
                                    'vars'       => '{id},\'' . $table . '\''
            )),
            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Nuevo Campo',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_grupomodulos',
                                                    'title'     => 'grupomodulos',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_grupomodulos id, name  FROM grupomodulos',
                                                    'colclass'  => 'col-lg-6',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'width',
                                                'title'     => 'Ancho del Campo',
                                                'rules'     => 'trim|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),

                                            array(
                                                'name'      => 'descripcion',
                                                'title'     => 'Descripcion',
                                                'rules'     => 'trim|xss_clean',
                                                'type'      => 'textarea',
                                                'colclass'  => 'col-lg-12',
                                                'prop'      => ''
                                            )),
            ), 
            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Campo ',
                'campos'         => array(  array(
                                                    'name'      => 'name',
                                                    'title'     => 'Nombre',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_grupomodulos',
                                                    'title'     => 'grupomodulos',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_grupomodulos id, name  FROM grupomodulos',
                                                    'colclass'  => 'col-lg-6',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'width',
                                                'title'     => 'Ancho del Campo',
                                                'rules'     => 'trim|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),

                                            array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripcion',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'textarea',
                                                    'colclass'  => 'col-lg-12',
                                                    'prop'      => ''
                                            ),
                                           )),
        );
        return $data;
    }


    //Creación, edición de usuarios del sistema

    public function users(){

        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'users';
            $name              = 'users';
            $data['submodulo'] = $this->auth->get_submodulos_by_identificacion($name);
            $data['group']     = $this->auth->get_group_modulos_by_id($name);
            $this->view("private/pages/mto", $data);
        }
    }


    private function list_users($table)
    {
        $data = array(
            'table'     => $table,
            'dbdefault' => 'desarrollo_access',
            'campos' => array(  array(
                                        'name'  => 'username',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),

                                array(
                                        'name'  => 'email',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                
                                array(
                                        'name'  => 'sede',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'desarrollo_access.sedes as se',
                                        'joinrelthis'  =>  $table.'.sede_default',
                                        'joinrelchild' => 'se.id_sedes',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                        'sqlconsult'   => '',
                                    ),

                                array(
                                        'name'  => 'activated',
                                        'width' => '100',
                                        'class' => '',
                                        'join'  => FALSE,
                                        'type'  => 2,
                                    )),

            'select' => 'id_users, username, password, email, activated, se.name sede',
            'search' => array('descripcion'),
            'accion' => array(
                                array(
                                    'objeto'     => 'buttom',
                                    'objetype'   => '', //for input
                                    'prop'       => '',
                                    'class'      => 'btn btn-info btn-sm',
                                    'title'      => 'Editar',
                                    'color'      => 'bg-info', //bg-danger - bg-warning - bg-primary -bg-dark - bg-info
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'edit',
                                    'icon'       => 'fa fa-edit',
                                    'vars'       => '{id},\'' . $table . '\''
                                ),

                                array(
                                    'objeto'     => 'buttom',
                                    'prop'       => '',
                                    'class'       => 'btn btn-danger btn-sm',
                                    'title'      => 'Eliminar',
                                    'color'      => '', //bg-danger - bg-warning - bg-primary -bg-dark 
                                    'accion'     => TRUE,
                                    'event'      => 'onclick',
                                    'event_name' => 'eliminar',
                                    'icon'       => 'fa fa-danger',
                                    'vars'       => '{id},\'' . $table . '\''
                            )),
            'form_add'  => array(
                                    'origin'         => 'manual',
                                    'title'          => 'Crear Usuario',
                                    'function'       => 'modal_users',
                                    'campos'         => array()
                                ),
            'form_edit' => array(
                                    'origin'         => 'auto',
                                    'title'          => 'Editar Usuario',
                                    'function'       => 'modal_users',
                                    'campos'         => array()
                                ),
        );
        return $data;
    }


    public function modal_users($table, $title, $id = null){
        
        $accion       = '?c=app&a=add_user';
        $username     = '';
        $password     = '';
        $email        = '';
        $activated    = '';
        $sede_default = '';

        $sql      =  'SELECT * FROM desarrollo_access.sedes';
        $sedes    =  $this->datatable->get_list_data_by_id($sql);

        if(!empty($id)){ $query =  $this->datatable->get_table_by_id($table, $id);
            if(!empty($query)){

                $username     = $query['username'];
                $password     = $query['password'];
                $email        = $query['email'];
                $activated    = $query['activated'];
                $sede_default = $query['sede_default'];
                $accion       = '?c=app&a=update_user';
        } }?>

        <div class="modal-content modal-lg">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_<?= $table ?>" method="POST">  
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="hidden" name="table" value="<?= $table ?>">
                    <div class="row">

                        <div class="col-lg-9">
                            <div class="form-group">
                                <label><b>Nombre del usuario</b></label>
                                <input type="text" class="form-control" name="username" id="username" value="<?=$username?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-3 pt-5">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input " value="1" type="checkbox" name="activated" id="activated">
                                <label class="custom-control-label" for="estado"><b>Estado</b></label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><b>Email</b></label>
                                <input type="text" class="form-control" name="email" id="email" value="<?=$username?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Contraseña del Usuario</b></label>
                                <input type="text" class="form-control" name="password" id="password" value="<?=$password?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Confirmar Contraseña</b></label>
                                <input type="text" class="form-control" name="confirm" id="confirm" value="<?=$password?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><b>Sede por defecto</b></label>
                                <select class="selectpicker form-control" name="sede_default" id="sede_default"  data-style="form-control" data-live-search="true">
                                    <option value="">Seleccione una opción</option>
                                    <?php if (!empty($sedes)) {  foreach ($sedes as $keys ) { ?>
                                        <option value="<?=$keys['id_sedes']?>"  <?=$sede_default == $keys['id_sedes']? 'selected="selected"' : ''?>>
                                            <?=strtoupper($keys['name'])?>
                                        </option><?php } }else{ ?> <option value="">Sin datos.</option>
                                    <?php } ?>
                                </select>
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnkit" onclick="save('<?= $table ?>', '<?=$accion?>')">Guardar Cambios</button>
            </div>
          </div>
        <?php
    }


    public function add_user(){

        $this->_validate_user();
    }

    public function update_user(){

        $this->_validate_user();
    }

    private function  _validate_user(){

           //$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
           $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
           $this->form_validation->set_rules('username', 'Nombre del Usuario', 'required');
           //$this->form_validation->set_rules('password', 'Contraseña', 'required');
           //$this->form_validation->set_rules('confirm', 'Confimar Contraseña', 'required');
           //$this->form_validation->set_rules('sede_default', 'Sede', 'required');
   
           $this->form_validation->set_error_delimiters('', '');
   
           $data['inputerror']    = array();
           $data['error_string']  = array();
           $data['status']        = TRUE;
   
           if (!$this->form_validation->run()) { // validation ok
   
               $data['inputerror'][]   = 'username';
               $data['error_string'][] = $this->form_validation->error('username');
               $data['status'] = FALSE;

               $data['inputerror'][]   = 'email';
               $data['error_string'][] = $this->form_validation->error('email');
               $data['status'] = FALSE;

               $data['inputerror'][]   = 'password';
               $data['error_string'][] = $this->form_validation->error('password');
               $data['status'] = FALSE;

               $data['inputerror'][]   = 'confirm';
               $data['error_string'][] = $this->form_validation->error('confirm');
               $data['status'] = FALSE;
   
               $data['inputerror'][]   = 'sede_default';
               $data['error_string'][] = $this->form_validation->error('sede_default');
               $data['status'] = FALSE;
   
               echo json_encode($data);
               exit;
           }
    }


} //fin clase UsuariosController ?> 