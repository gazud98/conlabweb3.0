<?php
class Compra_inventarioController extends ControladorBase
{   
    
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::Compra_inventarioModel();
    }

    public function mto_compra_inventario()
    {
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'compra_inventario';
            $name              = 'mto_compra_inventario';
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

    private function list_bodegas($table){

        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'codigo',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'  => 'nombre',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => dblab.'centros_costos as c',
                                        'joinrelthis'  => 'id_centro_costo',
                                        'joinrelchild' => 'c.id_centros_costos',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                    ),
                                array(
                                            'name'  => 'bodega',
                                            'width' => '',
                                            'class' => '',
                                            'join'  => FALSE,
                                        ),
                                array(
                                        'name'  => 'empleado',
                                        'width' => '',
                                        'class' => '',
                                        'join'         =>  FALSE,
                                        'jointable'    =>  prefixdb.'access.empleados as em',
                                        'joinrelthis'  => 'id_empledos',
                                        'joinrelchild' => 'ci.idempleados',
                                        'joinpotition' => 'INNER',
                                        'sql'          => TRUE,
                                        'sqlconsult'   => 'INNER JOIN '.prefixdb.'_access.empleados as em ON (em.id_empleados = '.$table.'.id_empleado) 
                                                           INNER JOIN '.prefixdb.'_access.persona as per ON (per.id_persona = em.id_persona)',
                                    ),
                                array(
                                        'name'  => 'estado',
                                        'width' => '',
                                        'class' => 'btn btn-success',
                                        'join'  => FALSE,
                                        'type'  => 2, //describe el tipo de campo accion 1 , default, de estado ...
                                    )),
            'select' => 'id_bodegas, '.$table.'.codigo, c.nombre, bodega, UPPER(CONCAT(per.apellido_1," ",per.apellido_2," ",per.nombre_1," ",per.nombre_2)) empleado, '.$table.'.estado',
            'search' => array('codigo'),
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
                            'origin'         => 'manual',
                            'title'          => 'Crear Nueva Bodega',
                            'function'       => 'bodega_modal',
                            'campos'         => array(
                                                        array('name' => 'codigo', 'rules'            => array('required')),
                                                        array('name' => 'id_centro_costo', 'rules'   => array('required')),
                                                        array('name' => 'bodega', 'rules'            => array('required')),
                                                        array('name' => 'id_empleado', 'rules'       => array('required')),
                                                        array('name' => 'estado', 'rules'            => array()),

                                        ),
            ),
            'form_edit' => array(
                            'origin'         => 'manual',
                            'title'          => 'Editar Bodega',
                            'function'       => 'bodega_modal',
                            'campos'         => array(  
                                                        array('name' => 'codigo', 'rules'            => array('required')),
                                                        array('name' => 'id_centro_costo', 'rules'   => array('required')),
                                                        array('name' => 'bodega', 'rules'            => array('required')),
                                                        array('name' => 'id_empleado', 'rules'       => array('required')),
                                                        array('name' => 'estado', 'rules'            => array()),
                                                    ),
            ),

        );

        return $data;
    }



    private function list_tipo_linea_producto($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'nombre',
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
                                    'title'          => 'Agregar Tipo línea Producto',
                                    'campos'         => array(  array(
                                                                        'name'      => 'nombre',
                                                                        'title'     => 'Nombre',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'class'     => '',
                                                                        'prop'      => ''
                                                                    ))),
                

            'form_edit' => array(
                                    'origin'         => 'auto',
                                    'title'          => 'Editar Tipo linea Producto',
                                    'campos'         => array(  array(
                                                                        'name'      => 'nombre',
                                                                        'title'     => 'Nombre',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'class'     => '',
                                                                        'prop'      => ''))),

        );
        return $data;
    }


    private function list_frecuencia_compra($table)
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
                                    'name'  => 'tiempo_reorden',
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
                                    'title'          => 'Agregar Frecuencia de Compra',
                                    'campos'         => array(  array(
                                                                        'name'      => 'descripcion',
                                                                        'title'     => 'Descripción',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'colclass'  => 'col-lg-7',
                                                                        'prop'      => ''),
                                                                array(
                                                                        'name'      => 'tiempo_reorden',
                                                                        'title'     => 'Tiempo Reorden (Dias)',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'input',
                                                                        'inputype'  => 'number',
                                                                        'colclass'  => 'col-lg-5',
                                                                        'prop'      => 'min="1" max="365"'
                                                                    ))),
                

            'form_edit' => array(
                                    'origin'         => 'auto',
                                    'title'          => 'Editar Frecuencia de compra',
                                    'campos'         => array(  array(
                                                                        'name'      => 'descripcion',
                                                                        'title'     => 'Descripción',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'class'     => '',
                                                                        'prop'      => ''),
                                                                array(
                                                                        'name'      => 'tiempo_reorden',
                                                                        'title'     => 'Tiempo Reorden (Dias)',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'input',
                                                                        'inputype'  => 'text',
                                                                        'class'     => '',
                                                                        'prop'      => 'min="1" max="366"'
                                                                    ))),

        );

        return $data;
    }


    private function list_unidad_empaque($table)
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
                                    'title'          => 'Agregar Unidad de Empaque',
                                    'campos'         => array(  array(
                                                                        'name'      => 'descripcion',
                                                                        'title'     => 'Descripción',
                                                                        'rules'     => 'trim|required|xss_clean',
                                                                        'type'      => 'textarea',
                                                                        'inputype'  => '',
                                                                        'class'     => '',
                                                                        'prop'      => ''
                                                                    ))),
                

            'form_edit' => array(
                'origin'         => 'auto',
                'title'          => 'Editar Unidad de Empaque',
                    'campos'     => array(  array(
                                                    'name'      => 'descripcion',
                                                    'title'     => 'Descripción',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'textarea',
                                                    'inputype'  => '',
                                                    'class'     => '',
                                                    'prop'      => ''))),

        );
        return $data;
    }


    private function list_linea_producto($table)
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
                                        'jointable'    =>  dblab.'tipo_linea_producto as tp',
                                        'joinrelthis'  => 'linea_producto.id_tipo_linea_producto',
                                        'joinrelchild' => 'tp.id_tipo_linea_producto',
                                        'joinpotition' => 'INNER'),
                                array(
                                        'name'  => 'puc_debito',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE),
                                array(
                                        'name'  => 'puc_credito',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE)),
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
                                                    'name'      => 'id_tipo_linea_producto',
                                                    'title'     => 'Tipo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_tipo_linea_producto id, nombre name  FROM '.dblab.'tipo_linea_producto',
                                                    'class'     => '',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'puc_debito',
                                                    'title'     => 'PUC Débito',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'number',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'puc_credito',
                                                    'title'     => 'PUC Crédito',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'number',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),),
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
                                                    'name'      => 'id_tipo_linea_producto',
                                                    'title'     => 'Tpo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_tipo_linea_producto id, nombre name  FROM '.dblab.'tipo_linea_producto',
                                                    'class'     => '',
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'puc_debito',
                                                    'title'     => 'PUC Débito',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'number',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                ),
                                            array(
                                                    'name'      => 'puc_credito',
                                                    'title'     => 'PUC Crédito',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'input',
                                                    'inputype'  => 'number',
                                                    'colclass'  => 'col-lg-6',
                                                    'prop'      => ''
                                                )),
            ),

        );
        return $data;
    }


    



    //funciones personalizadas todas son funciones privadas.

    public function bodega_modal($table, $title, $id = null) { 

        $sedes     = $this->datatable->get_data_table_by_id('sedes', array());
        $sql       = 'SELECT * FROM empleados as e INNER JOIN persona as p ON(p.id_persona = e.id_persona)';
        $empleados = $this->datatable->get_list_data_by_id($sql);
        
        $id_centro_costo  = '';
        $id_sedes         = '';
        $ubicacion        = '';
        $codigo           = '';
        $bodega           = '';
        $id_empleado      = '';
        $estado           = '';

        if(!empty($id)){ $query =  $this->datatable->get_table_by_id($table, $id);
            if(!empty($query)){

                $id_centro_costo    =  $query['id_centro_costo'];
                $sql                = 'SELECT c.id_sedes FROM '.dblab.'centros_costos as c
                                       WHERE c.id_centros_costos = '.$id_centro_costo;
                $ubicacion          = $this->datatable->get_list_data_by_id($sql);
                $id_sedes           = $ubicacion[0]['id_sedes'];
                $codigo             = $query['codigo'];
                $bodega             = $query['bodega'];
                $id_empleado        = $query['id_empleado'];
                $estado             = $query['estado'];
    
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
                                <label><b>Código</b></label>
                                <input type="text" class="form-control" name="codigo" id="codigo" value="<?=$codigo?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Sede</b></label>
                                <select class="selectpicker form-control" name="sedes" id="sedes"  data-style="form-control" data-live-search="true">
                                    <option>Seleccione una sede</option>
                                    <?php if (!empty($sedes)) {
                                        foreach ($sedes as $key ) { ?>
                                            <option value="<?=$key['id_sedes']?>" <?=$id_sedes==$key['id_sedes']? 'selected="selected"':'' ?>><?=$key['name']?></option>
                                        <?php } }else{ ?> 
                                            <option>Sin datos.</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Centro de Costos</b></label>
                                <select class="form-control selectpicker" name="id_centro_costo" id="id_centro_costo" disabled="disabled"  data-live-search="true">
                                    <option>Seleccione un centro de costo</option>
                                </select>
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><b>Nombre de la Bodega</b></label>
                                <input type="text" class="form-control" name="bodega" id="bodega" value="<?=$bodega?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group">
                                <label><b>Usuario Encargado</b></label>
                                <select class="selectpicker form-control" name="id_empleado" id="id_empleado"  data-style="form-control" data-live-search="true">
                                <option value="">Seleccione una opción</option>
                                    <?php if (!empty($empleados)) {
                                        foreach ($empleados as $keys ) { ?>
                                            <option value="<?=$keys['id_empleados']?>"  <?=$id_empleado == $keys['id_empleados']? 'selected="selected"' : ''?>><?=strtoupper($keys['apellido_1'].' '.$keys['apellido_2'].' '.$keys['nombre_1'].' '.$keys['nombre_2'])?></option>
                                        <?php } }else{ ?> 
                                            <option value="">Sin datos.</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="pt-5 col-lg-4">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input " value="1" type="checkbox" name="estado" id="estado" <?= $estado == 1? 'checked' : ''?>>
                                <label class="custom-control-label" for="estado"><b>Estado</b></label>
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
                    get_query('<?=dblab?>centros_costos', <?=$id_sedes?>, 'id_sedes', '#form_bodegas #id_centro_costo', <?=$id_centro_costo?>, 'nombre', 'id_centros_costos'); 
                    $('#form_bodegas #id_centro_costo').attr('disabled',false);
                <?php } ?>
               
                $("#form_bodegas select[name='sedes']").change(function() {
                    var sede         = $("select[name='sedes']");
                    var centro_costo = $("select[name='centro_costo']");
                    $("#form_bodegas  select[name='sedes'] option:selected").each(function(){ 
                        get_query('<?=dblab?>centros_costos', sede.val(), 'id_sedes', '#form_bodegas #id_centro_costo', null, 'nombre', 'id_centros_costos'); 
                        $('#form_bodegas #id_centro_costo').attr('disabled',false);
                    });
                });

            });
        </script>
    <?php }

} //fin clase UsuariosController 
