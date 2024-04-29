<?php
class EstandarController extends ControladorBase
{    

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::EstandarModel();
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

    public function programabase()
    {
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'estandar';
            $name              = 'programabase';
            $data['submodulo'] = $this->auth->get_submodulos_by_identificacion($name);
            $data['group']     = $this->auth->get_group_modulos_by_id($name);
            $this->view("private/pages/estandar", $data);
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

    private function list_canal_informacion($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(array(
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
                'title'          => 'Agregar Canal de Información',
                'campos'         => array(array(
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
                'title'          => 'Editar Canal de Información',
                    'campos'     => array(array(
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

    private function list_categorias_clinicas($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(array(
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
                'title'          => 'Agregar Tipo Contacto',
                'campos'         => array(array(
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
                'title'          => 'Editar tipo contacto',
                    'campos'     => array(array(
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


    private function list_motivos_pqr($table){

        $data = array(
            'table'  => $table,
            'campos' => array(array(
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
                'title'          => 'Agregar Motivo PQR',
                'campos'         => array(array(
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
                'title'          => 'Editar Motivo PQR',
                    'campos'     => array(array(
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


    private function list_rutas_domicilio($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(
                array(
                    'name'  => 'descripcion',
                    'width' => '',
                    'class' => '',
                    'join'  => FALSE,
                ),
                array(
                    'name'  => 'ciudad',
                    'width' => '',
                    'class' => '',
                    'join'         =>  TRUE,
                    'jointable'    => 'cw3_config.cities as ci',
                    'joinrelthis'  => 'id_ciudad',
                    'joinrelchild' => 'ci.id',
                    'joinpotition' => 'INNER',
                    'sql'          => FALSE,
                    'sqlconsult'   => '', //'INNER JOIN cw3_config.cities ON (ciudad = cw3_config.cities.id)',
                ),
                array(
                    'name'  => 'valor',
                    'width' => '',
                    'class' => '',
                    'join'  => FALSE,
                ),
            ),

            'select' => 'id_' . $table . ', descripcion, ci.name ciudad, valor, id_tecnico',
            'order'  => '',
            'search' => array('descripcion', 'name', 'valor'),
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
                ),

            ),
            'form_add'  => array(
                                    'origin'         => 'manual',
                                    'title'          => 'Crear Nueva Ruta de Domicilios',
                                    'function'       => 'rutas_domicilio_modal',
                                    'campos'         => array(
                                                                array('name' => 'descripcion', 'rules' => array('required')),
                                                                array('name' => 'valor', 'rules'       => array('required')),
                                                                array('name' => 'id_ciudad', 'rules'   => array('required')),
                                                                array('name' => 'hora_inicio', 'rules' => array('required')),
                                                                array('name' => 'hora_fin', 'rules'    => array('required')),
                                                                array('name' => 'intervalo', 'rules'   => array('required')),
                                                                array('name' => 'id_tecnico', 'rules'   => array('required')),
                                                            ),
            ),
            'form_edit' => array(
                                    'origin'         => 'manual',
                                    'title'          => 'Editar Ruta de Domicilio',
                                    'function'       => 'rutas_domicilio_modal',
                                    'campos'         => array(  
                                                                array('name' => 'descripcion', 'rules' => array('required')),
                                                                array('name' => 'valor', 'rules'       => array('required')),
                                                                array('name' => 'id_ciudad', 'rules'   => array('required')),
                                                                array('name' => 'hora_inicio', 'rules' => array('required')),
                                                                array('name' => 'hora_fin', 'rules'    => array('required')),
                                                                array('name' => 'intervalo', 'rules'   => array('required')),
                                                                array('name' => 'id_tecnico', 'rules'   => array('required')),
                                                             ),
            ),

        );

        return $data;
    }

    private function list_servicio_adicional($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(array(
                                    'name'  => 'descripcion',
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
                'title'          => 'Agregar Servicio Adicional',
                'campos'         => array(array(
                                                'name'      => 'descripcion',
                                                'title'     => 'Descripción',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'textarea',
                                                'inputype'  => '',
                                                'class'     => '',
                                                'prop'      => ''
                                            ),
                                        array(
                                                'name'      => 'valor',
                                                'title'     => 'Valor',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'input',
                                                'inputype'  => 'number',
                                                'class'     => '',
                                                'prop'      => ''
                                            )),
            ),

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Servicio Adicional',
                    'campos'     => array(array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''),
                                          array(
                                                    'name'      => 'valor',
                                                    'title'     => 'Valor',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'number',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                ))
            ),

        );
        return $data;
    }


    private function list_tipo_contacto($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(array(
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
                'title'          => 'Agregar Tipo Contacto',
                'campos'         => array(array(
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
                'title'          => 'Editar Tipo Contacto',
                    'campos'     => array(array(
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

    private function list_tipo_crm($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(array(
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
                'title'          => 'Agregar Tipo Cmr',
                'campos'         => array(array(
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
                'title'          => 'Editar Tipo Cmr',
                    'campos'     => array(array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''),
                                                ),
            ),

        );
        return $data;
    }

    //funciones personalizadas todas son funciones privadas.

    public function rutas_domicilio_modal($table, $title, $id = null) { 

        $paises   = $this->datatable->get_data_table_by_id('cw3_config.countries', array());
        $sql      = 'SELECT * FROM empleados as e INNER JOIN persona as p ON(p.id_persona = e.id_persona)';
        $tecnicos = $this->datatable->get_list_data_by_id($sql);

        $descripcion  = '';
        $pais         = '';
        $departamento = '';
        $id_ciudad    = '';
        $hora_inicio  = '';
        $hora_fin     = '';
        $intervalo    = '';
        $valor        = '';
        $id_tecnico   = '';

        if(!empty($id)){ $query =  $this->datatable->get_table_by_id($table, $id);
            if(!empty($query)){

                
                $id_ciudad    = $query['id_ciudad'];

                $sql          = 'SELECT s.id states_id, co.id countries_id FROM cw3_config.cities as c
                                 INNER JOIN cw3_config.states as s 
                                 ON(c.state_id = s.id)
                                 INNER JOIN cw3_config.countries as co 
                                 ON(co.id = s.country_id)
                                 WHERE c.id = '.$id_ciudad;
                $ubicacion    = $this->datatable->get_list_data_by_id($sql);
                $departamento =  $ubicacion[0]['states_id'];
                $pais         =  $ubicacion[0]['countries_id'];
                $descripcion  = $query['descripcion'];
                $hora_inicio  = $query['hora_inicio'];
                $hora_fin     = $query['hora_fin'];
                $intervalo    = $query['intervalo'];
                $valor        = $query['valor'];
                $id_tecnico   = $query['id_tecnico'];
    
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><b>Descripción</b></label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=$descripcion?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>País</b></label>
                                <select class="selectpicker form-control" name="pais" id="pais"  data-style="form-control" data-live-search="true">
                                    <option>Seleccione un país</option>
                                    <?php if (!empty($paises)) {
                                        foreach ($paises as $key ) { ?>
                                            <option value="<?=$key['id']?>" <?=$pais==$key['id']? 'selected="selected"':'' ?>><?=$key['name']?></option>
                                        <?php } }else{ ?> 
                                            <option>Sin datos.</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Departamento</b></label>
                                <select class="form-control selectpicker" name="departamento" id="departamento" disabled="disabled"  data-live-search="true">
                                    <option>Seleccione un departamento</option>
                                </select>
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Ciudad o Municipio</b></label>
                                <select class="form-control selectpicker" name="id_ciudad" id="id_ciudad" <?=empty($id)?'disabled="disabled"':''?>  data-live-search="true">
                                    <option>Seleccione una ciudad</option>
                                </select>
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Hora de inicio</b></label>
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="<?=$hora_inicio?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Hora final</b></label>
                                <input type="time" class="form-control" name="hora_fin" id="hora_fin" value="<?=$hora_fin?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Intervalo [Min]</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="intervalo" id="intervalo" value="<?=$intervalo?>" min="1" >
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Valor</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="valor" id="valor" min="1" max="60" value="<?=$valor?>">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="form-group">
                                <label><b>Técnico encargado</b></label>
                                <select class="selectpicker form-control" name="id_tecnico" id="id_tecnico"  data-style="form-control" data-live-search="true">
                                <option value="">Seleccione una opción</option>
                                    <?php if (!empty($tecnicos)) {
                                        foreach ($tecnicos as $keys ) { ?>
                                            <option value="<?=$keys['id_empleados']?>"  <?=$id_tecnico == $keys['id_empleados']? 'selected="selected"' : ''?>><?=strtoupper($keys['apellido_1'].' '.$keys['apellido_2'].' '.$keys['nombre_1'].' '.$keys['nombre_2'])?></option>
                                        <?php } }else{ ?> 
                                            <option value="">Sin datos.</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnkit" onclick="save('<?= $table ?>')">Guardar Cambios</button>
            </div>
        </div>
        <script>
            $( document ).ready(function() {

                <?php if (!empty($id)) { ?>
                    get_query('cw3_config.states', <?=$pais?>, 'country_id', '#form_rutas_domicilio #departamento', <?=$departamento?>); 
                    get_query('cw3_config.cities', <?=$departamento?>, 'state_id', '#form_rutas_domicilio #id_ciudad', <?=$id_ciudad?>); 
                    $('#form_rutas_domicilio #departamento').attr('disabled',false);
                    $('#form_rutas_domicilio #id_ciudad').attr('disabled',false);
                <?php } ?>
               
                $("#form_rutas_domicilio select[name='pais']").change(function() {
                    var pais   = $("select[name='pais']");
                    var dpto   = $("select[name='departamento']");
                    var ciudad = $("select[name='ciudad']");
                    $("#form_rutas_domicilio  select[name='pais'] option:selected").each(function(){ 
                        get_query('cw3_config.states', pais.val(), 'country_id', '#form_rutas_domicilio #departamento'); 
                        $('#form_rutas_domicilio #departamento').attr('disabled',false);
                        $('#form_rutas_domicilio #id_ciudad').attr('disabled',true);
                    });
                });

                $("#form_rutas_domicilio select[name='departamento']").change(function() {
                    var dpto   = $("#form_rutas_domicilio select[name='departamento']");
                    var ciudad = $("#form_rutas_domicilio select[name='ciudad']");
                    $("#form_rutas_domicilio select[name='departamento'] option:selected").each(function(){ 
                        get_query('cw3_config.cities', dpto.val(), 'state_id', '#form_rutas_domicilio #id_ciudad'); 
                        $('#form_rutas_domicilio #id_ciudad').attr('disabled',false);
                    });
                });

            });
        </script>
    <?php }


} //fin clase UsuariosController 
