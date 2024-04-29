<?php
class ComercialController extends ControladorBase
{  
    
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::ComercialModel();
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

    public function mto_comercial()
    {
        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['ctrl']      = 'comercial';
            $name              = 'mto_comercial';
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

    private function list_procedencias($table){

        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                array(
                                        'name'    => 'name',
                                        'width'   => '',
                                        'class'   => 'btn btn-success',
                                        'join'    => TRUE,
                                        'jointable'    =>  dblab.'tipo_procedencias as tp',
                                        'joinrelthis'  => 'procedencias.id_tipo_procedencia',
                                        'joinrelchild' => 'tp.id_tipo_procedencias',
                                        'joinpotition' => 'INNER'),
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
                                                    'prop'      => ''
                                            ),
                                            array(
                                                    'name'      => 'id_tipo_procedencia',
                                                    'title'     => 'Tipo',
                                                    'rules'     => 'trim|required|xss_clean',
                                                    'type'      => 'select',
                                                    'datasql'   => 'SELECT id_tipo_procedencias id, name  FROM '.dblab.'tipo_procedencias',
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
                                                'prop'      => ''),
                                        array(
                                                'name'      => 'id_tipo_procedencia',
                                                'title'     => 'Tipo',
                                                'rules'     => 'trim|required|xss_clean',
                                                'type'      => 'select',
                                                'datasql'   => 'SELECT id_tipo_procedencias id, name  FROM '.dblab.'tipo_procedencias',
                                                'class'     => '',
                                                'colclass'  => 'col-lg-8',
                                                'prop'      => ''),
                                        array(
                                                'name'      => 'estado',
                                                'title'     => 'Estado',
                                                'rules'     => 'trim|xss_clean',
                                                'type'      => 'checkbox',
                                                'inputype'  => '',
                                                'colclass'  => 'col-lg-4',
                                                'prop'      => '')),
            ),

        );

        return $data;
    }


    private function list_especialidad_medica($table)
    {
        $data = array(
            'table'  => $table,
            'campos' => array(  array(
                                        'name'  => 'descripcion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE,
                                    ),
                                ),
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
                                                'prop'      => '')),
            ),

        );
        
        return $data;
    }

    private function list_centro_medico($table)
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
                                        'name'         => 'departamento',
                                        'width'        => '',
                                        'class'        => '',
                                        'join'         => FALSE,
                                        'sql'          => TRUE,
                                        'sqlconsult'   => 'INNER JOIN cw3_config.cities ON (id_ciudad = cw3_config.cities.id) INNER JOIN cw3_config.states ON (cw3_config.cities.state_id = cw3_config.states.id)'),
                                array(
                                        'name'         => 'ciudad',
                                        'width'        => '',
                                        'class'        => '',
                                        'join'         =>  TRUE,
                                        'jointable'    => 'cw3_config.cities as ci',
                                        'joinrelthis'  => 'id_ciudad',
                                        'joinrelchild' => 'ci.id',
                                        'joinpotition' => 'INNER',
                                        'sql'          => FALSE,
                                        'sqlconsult'   => '', //'INNER JOIN cw3_config.cities ON (ciudad = cw3_config.cities.id)',
                                    ),
                                array(
                                        'name'  => 'direccion',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE),
                                array(
                                        'name'  => 'adicional',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE),
                                array(
                                        'name'  => 'contacto',
                                        'width' => '',
                                        'class' => '',
                                        'join'  => FALSE)
                            ),
            'select' => 'id_' . $table . ', descripcion, cw3_config.states.name departamento, cw3_config.cities.name ciudad, direccion, contacto, adicional',
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
                                    'origin'         => 'manual',
                                    'title'          => 'Crear Nueva Centro Médico',
                                    'function'       => 'centro_medico_modal',
                                    'campos'         => array(
                                                                array('name' => 'descripcion', 'rules' => array('required')),
                                                                array('name' => 'id_ciudad', 'rules'   => array('required')),
                                                                array('name' => 'direccion', 'rules' => array('required')),
                                                                array('name' => 'contacto', 'rules'    => array('required')),
                                                                array('name' => 'adicional', 'rules'   => array('required')),
                                                            ),
                                ),
            'form_edit' => array(
                                    'origin'         => 'manual',
                                    'title'          => 'Editar Centro Médico',
                                    'function'       => 'centro_medico_modal',
                                    'campos'         => array(  
                                                                array('name' => 'descripcion', 'rules' => array('required')),
                                                                array('name' => 'id_ciudad', 'rules'   => array('required')),
                                                                array('name' => 'direccion', 'rules' => array('required')),
                                                                array('name' => 'contacto', 'rules'    => array('required')),
                                                                array('name' => 'adicional', 'rules'   => array('required')),
                                                            ),
            ),

        );
        
        return $data;
    }

    //funciones personalizadas todas son funciones privadas.

    public function centro_medico_modal($table, $title, $id = null) { 

        $paises   = $this->datatable->get_data_table_by_id('cw3_config.countries', array());

        $descripcion  = '';
        $pais         = '';
        $departamento = '';
        $id_ciudad    = '';
        $direccion    = '';
        $direccion    = '';
        $adicional    = '';

        if(!empty($id)){ $query =  $this->datatable->get_table_by_id($table, $id);
            if(!empty($query)){
                $id_ciudad    =  $query['id_ciudad'];
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
                $direccion    = $query['direccion'];
                $contacto     = $query['contacto'];
                $adicional    = $query['adicional'];    
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
                                <label><b>Dirección</b></label>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="<?=$direccion?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Contacto</b></label>
                                <input type="text" class="form-control" name="contacto" id="contacto" value="<?=$direccion?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><b>Informaciómn Adicional</b></label>
                                <input type="text" class="form-control" name="adicional" id="adicional" value="<?=$adicional?>">
                                <span class="help-block" style="color: red; font-size: 12px"></span>
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
                    get_query('cw3_config.states', <?=$pais?>, 'country_id', '#form_centro_medico #departamento', <?=$departamento?>); 
                    get_query('cw3_config.cities', <?=$departamento?>, 'state_id', '#form_centro_medico #id_ciudad', <?=$id_ciudad?>); 
                    $('#form_centro_medico #departamento').attr('disabled',false);
                    $('#form_centro_medico #id_ciudad').attr('disabled',false);
                <?php } ?>
               
                $("#form_centro_medico select[name='pais']").change(function() {
                    var pais   = $("select[name='pais']");
                    var dpto   = $("select[name='departamento']");
                    var ciudad = $("select[name='ciudad']");
                    $("#form_centro_medico  select[name='pais'] option:selected").each(function(){ 
                        get_query('cw3_config.states', pais.val(), 'country_id', '#form_centro_medico #departamento'); 
                        $('#form_centro_medico #departamento').attr('disabled',false);
                        $('#form_centro_medico #id_ciudad').attr('disabled',true);
                    });
                });

                $("#form_centro_medico select[name='departamento']").change(function() {
                    var dpto   = $("#form_centro_medico select[name='departamento']");
                    var ciudad = $("#form_centro_medico select[name='ciudad']");
                    $("#form_centro_medico select[name='departamento'] option:selected").each(function(){ 
                        get_query('cw3_config.cities', dpto.val(), 'state_id', '#form_centro_medico #id_ciudad'); 
                        $('#form_centro_medico #id_ciudad').attr('disabled',false);
                    });
                });

            });
        </script>
    <?php }

} //fin clase UsuariosController 
