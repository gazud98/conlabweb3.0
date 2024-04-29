<?php 
class CostosController extends ControladorBase{

    private $model;
 
    public function __construct(){
        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::costosmodel();
    }

    public function index(){

        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['examenes'] = $this->model->get_info_kits();
            $data['sedes']    = $this->model->get_sedes();
            $this->view("private/pages/Costos", $data);
        }
    }


    public function mto_costos(){

        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'costos';
            $name              = 'mto_costos';
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

    
    private function list_costos_indirectos_fabricacion($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array( array(
                                    'name'  => 'ano_mes',
                                    'width' => '',
                                    'class' => '',
                                    'join'  => FALSE,
                                ),
                              array(
                                    'name'  => 'ano_mes',
                                    'width' => '',
                                    'class' => '',
                                    'join'  => FALSE,
                              ),
                              array(
                                    'name'         => 'name',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         =>  TRUE,
                                    'jointable'    => 'sedes as se',
                                    'joinrelthis'  => 'id_sede',
                                    'joinrelchild' => 'se.id_sedes',
                                    'joinpotition' => 'INNER',
                                    'sql'          => FALSE,
                               ),
                               array(
                                    'name'         => 'descripcion',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         =>  TRUE,
                                    'jointable'    =>  dblab.'descripcion_costo as dc',
                                    'joinrelthis'  => 'dc.id_descripcion_costo',
                                    'joinrelchild' => $table.'.id_descripcion_costo',
                                    'joinpotition' => 'INNER',
                                    'sql'          => FALSE,
                               ),
                              array(
                                    'name'  => 'valor',
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
                'title'          => 'Agregar Costo Indirecto de Fabricación',
                'campos'         => array(
                                        array(
                                            'name'      => 'id_sede',
                                            'title'     => 'Sede del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'select',
                                            'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                            'class'     => '',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),
                                        array(
                                            'name'      => 'id_descripcion_costo',
                                            'title'     => 'Descripción',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'select',
                                            'datasql'   => 'SELECT id_descripcion_costo id, descripcion name  FROM '.dblab.'descripcion_costo',
                                            'class'     => '',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),
                                        array(
                                            'name'      => 'valor',
                                            'title'     => 'Valor',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'number',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),
                                        array(
                                            'name'      => 'ano_mes',
                                            'title'     => 'Fecha del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'month',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),
                                        array(
                                            'name'      => 'motivo_costos',
                                            'title'     => 'Motivo del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'textarea',
                                            'inputype'  => '',
                                            'class'     => '',
                                            'prop'      => ''
                                        ),),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Costo Indirecto de Fabricación',
                    'campos'     => array(
                                            array(
                                                'name'      => 'id_sede',
                                                'title'     => 'Sede del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'select',
                                                'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                                'class'     => '',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'id_descripcion_costo',
                                                'title'     => 'Descripción',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'select',
                                                'datasql'   => 'SELECT id_descripcion_costo id, descripcion name  FROM '.dblab.'descripcion_costo',
                                                'class'     => '',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'valor',
                                                'title'     => 'Valor',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'ano_mes',
                                                'title'     => 'Fecha del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'month',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                            ),
                                            array(
                                                'name'      => 'motivo_costos',
                                                'title'     => 'Motivo del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'textarea',
                                                'inputype'  => '',
                                                'class'     => '',
                                                'prop'      => ''
                                            ))),

        );
        return $data;
    }


    private function list_descripcion_costo($table)
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
                                        'name'         => 'area',
                                        'width'        => '',
                                        'class'        => '',
                                        'join'         =>  TRUE,
                                        'jointable'    =>  dblab.'areas_laboratorio as ar',
                                        'joinrelthis'  => 'id_area_laboratorio',
                                        'joinrelchild' => 'ar.id_areas_laboratorio',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                   ),
                                array(
                                        'name'  => 'costo_fijo',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                        'type'  => '2'
                                ),
                                
                                ),
            'select' => 'id_'. $table.', '.$table.'.descripcion, ar.descripcion area, costo_fijo',
            'search' => array($table.'descripcion'),
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
                                    'title'          => 'Agregar Descripción del Costo',
                                    'campos'         => array(  array(
                                                                        'name'      => 'descripcion',
                                                                        'title'     => 'Descripción',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'prop'      => ''
                                                                ),
                                                                array(
                                                                        'name'      => 'id_area_laboratorio',
                                                                        'title'     => 'Area del Laboratorio',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'select',
                                                                        'datasql'   => 'SELECT id_areas_laboratorio id, descripcion name  FROM '.dblab.'areas_laboratorio',
                                                                        'class'     => '',
                                                                        'colclass'  => 'col-lg-8',
                                                                        'prop'      => ''
                                                                ),
                                                                array(
                                                                        'name'      => 'costo_fijo',
                                                                        'title'     => 'Costo Fijo',
                                                                        'rules'     => 'trim|xss_clean',
                                                                        'type'      => 'checkbox',
                                                                        'inputype'  => '',
                                                                        'colclass'  => 'col-lg-4',
                                                                        'prop'      => '')),
            ),

            'form_edit' => array(
                                    'origin'         => 'auto',
                                    'title'          => 'Editar Descripción del Costo',
                                    'campos'         => array(  array(
                                                                        'name'      => 'descripcion',
                                                                        'title'     => 'Descripción',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'prop'      => ''
                                                                ),
                                                                array(
                                                                        'name'      => 'id_area_laboratorio',
                                                                        'title'     => 'Area del Laboratorio',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'select',
                                                                        'datasql'   => 'SELECT id_areas_laboratorio id, descripcion name  FROM '.dblab.'areas_laboratorio',
                                                                        'class'     => '',
                                                                        'colclass'  => 'col-lg-8',
                                                                        'prop'      => ''
                                                                ),
                                                                array(
                                                                        'name'      => 'costo_fijo',
                                                                        'title'     => 'Costo Fijo',
                                                                        'rules'     => 'trim|xss_clean',
                                                                        'type'      => 'checkbox',
                                                                        'inputype'  => '',
                                                                        'colclass'  => 'col-lg-4',
                                                                        'prop'      => '')),
            ));
        
        return $data;
    }


    private function list_costos_fijos($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array( array(
                                        'name'  => 'fecha',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                ),
                                array(
                                        'name'  => 'fecha',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                ),
                                array(
                                        'name'         => 'name',
                                        'width'        => '',
                                        'class'        => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'sedes as se',
                                        'joinrelthis'  => 'id_sede',
                                        'joinrelchild' => 'se.id_sedes',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                ),
                                array(
                                        'name'  => 'nombre',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                ),
                                array(
                                        'name'  => 'valor',
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
                'title'          => 'Agregar Gastos Fijos',
                'campos'         => array(
                                        array(
                                                'name'      => 'nombre',
                                                'title'     => 'Descripción',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'textarea',
                                                'class'     => '',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'id_sede',
                                                'title'     => 'Sede del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'select',
                                                'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                                'class'     => '',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'fecha',
                                                'title'     => 'Fecha del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'date',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'valor',
                                                'title'     => 'Valor',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                        ))),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Gastos Fijos',
                'campos'     => array(
                                        array(
                                            'name'      => 'nombre',
                                            'title'     => 'Descripción',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'textarea',
                                            'class'     => '',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'id_sede',
                                            'title'     => 'Sede del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'select',
                                            'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                            'class'     => '',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'fecha',
                                            'title'     => 'Fecha del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'date',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'valor',
                                            'title'     => 'Valor',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'number',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ))));
        return $data;
    }


    private function list_mano_obra_directa($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array( 
                                array(
                                    'name'  => 'fecha',
                                    'width' => '',
                                    'class' => '',
                                    'join'  => FALSE,
                                ),
                                array(
                                    'name'         => 'sede',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         =>  TRUE,
                                    'jointable'    => 'sedes as se',
                                    'joinrelthis'  => 'id_sede',
                                    'joinrelchild' => 'se.id_sedes',
                                    'joinpotition' => 'INNER',
                                    'sql'          => FALSE,
                                ),
                                array(
                                    'name'         => 'area',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         =>  TRUE,
                                    'jointable'    =>  dblab.'areas_laboratorio as ar',
                                    'joinrelthis'  => 'id_area_laboratorio',
                                    'joinrelchild' => 'ar.id_areas_laboratorio',
                                    'joinpotition' => 'INNER',
                                    'sql'          => FALSE,
                                ),
                                array(
                                    'name'         => 'seccion',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         =>  TRUE,
                                    'jointable'    => 'seccion_empresa as sec',
                                    'joinrelthis'  => $table.'.id_seccion_empresa',
                                    'joinrelchild' => 'sec.id_seccion_empresa',
                                    'joinpotition' => 'INNER',
                                    'sql'          => FALSE,
                                ),
                                array(
                                    'name'  => 'id_cargo',
                                    'width' => '',
                                    'class' => '',
                                    'join'  => FALSE,
                                ),
                                array(
                                    'name'  => 'id_empleado',
                                    'width' => '',
                                    'class' => '',
                                    'join'         => FALSE,
                                ),
                                array(
                                    'name'         => 'valor',
                                    'width'        => '',
                                    'class'        => '',
                                    'join'         => FALSE,
                                )),

            'select' => 'id_mano_obra_directa, se.name sede, ar.descripcion area, sec.nombre seccion, id_cargo, id_empleado, tiempo_dedicacion, fecha, valor',
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
                'title'          => 'Agregar Mano de Obra Directa',
                'campos'         => array(
                                        array(
                                                'name'      => 'nombre',
                                                'title'     => 'Descripción',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'textarea',
                                                'class'     => '',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'id_sede',
                                                'title'     => 'Sede del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'select',
                                                'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                                'class'     => '',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'fecha',
                                                'title'     => 'Fecha del Costo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'date',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                        ),
                                        array(
                                                'name'      => 'valor',
                                                'title'     => 'Valor',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'colclass'  => 'col-lg-6',
                                                'prop'      => ''
                                        ))),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Gastos Fijos',
                'campos'     => array(
                                        array(
                                            'name'      => 'nombre',
                                            'title'     => 'Descripción',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'textarea',
                                            'class'     => '',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'id_sede',
                                            'title'     => 'Sede del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'select',
                                            'datasql'   => 'SELECT id_sedes id, name  FROM sedes',
                                            'class'     => '',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'fecha',
                                            'title'     => 'Fecha del Costo',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'date',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ),

                                        array(
                                            'name'      => 'valor',
                                            'title'     => 'Valor',
                                            'rules'     => 'trim|required|xss_clean',
                                            'type'      => 'input',
                                            'inputype'  => 'number',
                                            'colclass'  => 'col-lg-6',
                                            'prop'      => ''
                                        ))));
        return $data;
    }


    public function search_costos(){

        $examen = $this->input->POST('examen');
        $date   = $this->input->POST('date');
        $sede   = $this->input->POST('sede');
        
        if($sede != " "){
            $joinsede        = $sede != " "? 'INNER JOIN sedes as se  ON  (se.id_sedes  = xx.id_sede)': ''; 
            $selectsede      = $sede != " "? ', se.name as sede': '';
            $searchQuerysede = ' AND (xx.id_sede LIKE :id_sede) ';
            $searchArraysede = array("id_sede" => "%$sede%");
        }else{
            $joinsede         = '';
            $selectsede       = '';
            $searchQuerysede  = '';
            $searchArraysede  = array();
        }
        
        //Buscar Productos Asignados a los examenes
        $searchQuery = " AND (ape.id_examenes LIKE :id_examenes) ";
        $searchArray = array( 'id_examenes' => "%$examen%" );
        $sql = "SELECT pro.descripcion, ape.valor,  ape.rendimiento FROM ".dblab."asignacion_productos_examenes as ape 
                INNER JOIN ".dblab."productos as pro 
                ON (pro.id_productos = ape.id_productos) WHERE 1 ".$searchQuery; 
        $query = $this->model->get_dinamic_query($sql, $searchArray);
        
        //Buscar en costos indirectos de fabricación
        $searchQuery2 = "AND (xx.ano_mes LIKE :ano_mes) $searchQuerysede ";
        $searchArray2 = array('ano_mes' => "%$date%");
        $searchArray2 = !empty($searchArraysede)? array_merge($searchArray2, $searchArraysede): $searchArray2;

        $sql2 = "SELECT dc.descripcion, xx.valor ".$selectsede."
                 FROM ".dblab."costos_indirectos_fabricacion as xx 
                 INNER JOIN ".dblab."descripcion_costo as dc 
                 ON (dc.id_descripcion_costo = xx.id_descripcion_costo) ".$joinsede."
                 AND (xx.ano_mes LIKE :ano_mes) ".$searchQuery2; 
        
        $query2 = $this->model->get_dinamic_query($sql2,$searchArray2);
        
        //Buscar mano de obra asignada a la prueba
        $searchQuery3 = " AND (ape.id_examenes LIKE :id_examenes) $searchQuerysede";
        $searchArray3 = array( 'id_examenes' => "%$examen%");
        $searchArray3 = !empty($searchArraysede)? array_merge($searchArray3, $searchArraysede): $searchArray3;
                               
        $sql3 = "SELECT ape.id_asignacion_pruebas_empleados, car.nombre as cargo, 
                 ROUND(((((xx.valor/30)/xx.tiempo_dedicacion)/60)*ape.tiempo_prueba),0) as costo_examen, 
                 xx.tiempo_dedicacion, ape.tiempo_prueba, xx.valor as salario ".$selectsede."  
                 FROM ".dblab."mano_obra_directa as xx 
                 INNER JOIN ".dblab."asignacion_pruebas_empleados as ape 
                 ON (xx.id_mano_obra_directa = ape.id_empleados)
                 INNER JOIN ".dblab."info_kit as ik 
                 ON (ik.id_info_kit = ape.id_examenes)
                 LEFT JOIN cargos as car 
                 ON (car.id_cargos = xx.id_cargo) ".$joinsede."
                 WHERE 1 ".$searchQuery3; 

        $query3 = $this->model->get_dinamic_query($sql3, $searchArray3);

        $sum1 = $this->model->sum_data(dblab.'asignacion_productos_examenes' , array( 'id_examenes' => $examen ), 'SUM(valor)',' 1 ');
        $sum2 = $this->model->sum_data(dblab.'costos_indirectos_fabricacion' , array(), 'SUM(valor)', " ano_mes LIKE '%".$date."%' ");
        $sum3 = $this->model->sum_data(dblab.'asignacion_pruebas_empleados as ape ' ,  array( 'id_examenes' => $examen ), 
                                          'ROUND(SUM(((((md.valor/30)/md.tiempo_dedicacion)/60)*ape.tiempo_prueba)),0)', 
                                          " 1 ", " INNER JOIN  ".dblab."mano_obra_directa as md
                                          ON (md.id_mano_obra_directa = ape.id_empleados) ");
        
        echo json_encode(array($query, $query2, $query3, $sum1, $sum2, $sum3));

    }

    public function get_consumos_by_data(){

        $id    = $this->input->POST('id');
        $date  = $this->input->POST('date');
        $sede  = $this->input->POST('sedes');

        $query = $this->consumos_by_bonos($id, $date, $sede);

        echo json_encode( array(  'status'            => TRUE, 
                                  'examen_valor'      => $query['costos'],
                                  'examen_facturados' => $query['facturables'],
                                  'totalpruebas' => $query['totalpruebas'],));

    }

    private function  consumos_by_bonos($id, $date, $sede = null){
        
        $query = array();

        //grupo de pruebas no bonificacbles

        $query = $this->model->get_consumos_by_data($id, $date , $sede, 0 );

        $n_pruebas       = $query['pruebas'];  //contabiliza el total de las pruebas facturadas
        $n_calibradores  = $query['calibradores'];
        $n_controles     = $query['controles'];
        $n_repeticiones  = $query['verificaciones'];
        $venc_equipos  = $query['venc_equipos'];
        $n_diluciones  = $query['n_diluciones'];
        $nominales       = $query['nominales'];
        $costo           = $query['costo'];

        $n_facturables    =  $n_pruebas;

        $costo_compra     =  $costo > 0 ? $costo / $nominales: 0;
        $pruebas_totales  =  $n_facturables > 0? $n_facturables + $n_repeticiones: 0;
        $costo_esperado   =  $costo_compra * $pruebas_totales;
        $costo_proyectado =  $costo_compra * $n_facturables;
        $diferencia_costo =  $costo_esperado -  $costo_proyectado;
        $dispercion       =  $n_facturables > 0? $diferencia_costo / $n_facturables:0; 
        $costo_prueba     =  $costo_compra + $dispercion;

        //grupo de pruebas bonificables.

        $_query = $this->model->get_consumos_by_data($id, $date, $sede);

        $_n_pruebas       = $_query['pruebas'];  //contabiliza el total de las pruebas facturadas
        $_n_calibradores  = $_query['calibradores'];
        $_n_controles     = $_query['controles'];
        $_n_repeticiones  = $_query['verificaciones'];
        $_venc_equipos  = $_query['venc_equipos'];
        $_n_diluciones  = $_query['n_diluciones'];
        $_nominales       = $_query['nominales'];
        $_costo           = $_query['costo'];
  


        $statusbono        = $_n_calibradores + $_n_controles;
        $_n_facturables    =  $_n_pruebas;
        $_costo_compra     =  $_costo > 0 ? $_costo / $_nominales: 0;
        $_pruebas_totales  =  $_n_facturables > 0? $_n_facturables + $_n_repeticiones + $statusbono: 0;
        $_costo_esperado   =  $_costo_compra * $_pruebas_totales;
        $_costo_proyectado =  $_costo_compra * $_n_facturables;
        $_diferencia_costo =  $_costo_esperado -  $_costo_proyectado;
        $_dispercion       =  $_n_facturables > 0? $_diferencia_costo / $_n_facturables:0; 
        $_costo_prueba     =  $_costo_compra + $_dispercion;

        $prom_costo_prueba = ( $costo_prueba  + $_costo_prueba  );
        $pr_costo_prueba   = $costo_prueba  > 0 & $_costo_prueba  > 0 ? ($prom_costo_prueba / 2) : $prom_costo_prueba;
        $total_facturables = $n_facturables + $_n_facturables;
        $sumtotal         =   $n_calibradores + $n_controles +  $n_repeticiones + $n_diluciones+ $venc_equipos;

        return array( 'facturables' =>  $total_facturables, 
                      'costos'      =>  round( $pr_costo_prueba, 0 ),
                      'totalpruebas'  =>  round( $sumtotal, 0 ));

    } 

} //fin CONTROLLER COSTOS ?>