<?php
class CarteraController extends ControladorBase
{   
    
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::CarteraModel();
    }

    public function index()
    {
        //Dashboard princiapl. listado de modulos del sistema
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            $this->redirect("Auth", "send_again"); // logged in, not activated
        } else {
            $this->view("private/pages/Default");
        }
    }

    public function mto_cartera()
    {
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'cartera';
            $name              = 'mto_cartera';
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
        $where = array('id_' . $table => $id);
        $this->datatable->ajax_delete($table, $where);
    }

    
    public function get_data(){ $this->datatable->get_data(); }

    private function list_motivos_glosas($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
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
                                )
            ),

            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Agregar Motivo Glosas',
                'campos'         => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Motivo Glosas',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                 )),
            ),

        );
        return $data;
    }


    private function list_tipo_documento_contable($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'    => 'nombre',
                                        'width'   => '',
                                        'class'   => 'btn btn-success',
                                        'join'    => TRUE,
                                        'jointable'    =>  dblab.'tipo_notas_contables as tnc',
                                        'joinrelthis'  => 'tipo_documento_contable.id_tipo_notas_contables',
                                        'joinrelchild' => 'tnc.id_tipo_notas_contables',
                                        'joinpotition' => 'INNER')),
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
                                )
            ),

            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Agregar Canal de Información',
                'campos'         => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'id_tipo_notas_contables',
                                                    'title'     => 'Tipo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_tipo_notas_contables id, nombre name  FROM '.dblab.'tipo_notas_contables',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Canal de Información',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''),
                                            array(
                                                    'name'      => 'id_tipo_notas_contables',
                                                    'title'     => 'Tpo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_tipo_notas_contables id, nombre name  FROM '.dblab.'tipo_notas_contables',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                 )),
            ),

        );
        return $data;
    }


    private function list_entidades_bancarias($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'puc',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'estado',
                                        'type'  => 2, //describe el tipo de campo accion 1 , default, de estado ...
                                        'width' => '',
                                        'class' => 'btn btn-success',
                                        'join'  => FALSE,
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
                                )
            ),

            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Agregar Entidades Bancarias',
                'campos'         => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'puc',
                                                    'title'     => 'Puc',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'class'     => '',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Entidades Bancarias',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''),
                                            array(
                                                    'name'      => 'puc',
                                                    'title'     => 'PUC',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'text',
                                                    'colclass'  => 'col-lg-8',
                                                    'prop'      => ''),
                                            array(
                                                    'name'      => 'estado',
                                                    'title'     => 'Estado',
                                                    'rules'     => 'trim|xss_clean',
                                                    'type'      => 'checkbox',
                                                    'inputype'  => '',
                                                    'colclass'  => 'col-lg-4',
                                                    'prop'      => ''
                                                )),
            ),

        );
        return $data;
    }

    private function list_actividad_seguimiento($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
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
                                )
            ),

            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Agregar Actividad de seguimiento',
                'campos'         => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Actividad de seguimiento',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => '')),
            ),

        );
        return $data;
    }


    private function list_motivos_seguimiento($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
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
                                )
            ),

            'form_add'  => array(
                'origin'         => 'auto',
                'title'          => 'Agregar Actividad de seguimiento',
                'campos'         => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Actividad de seguimiento',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => '')),
            ),

        );
        return $data;
    }



} //fin clase UsuariosController 
