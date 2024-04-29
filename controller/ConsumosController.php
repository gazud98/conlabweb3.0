<?php
class ConsumosController extends ControladorBase
{
    private $model;

    public function __construct()
    {

        parent::__construct();
        $this->auth            = ControladorBase::auth_lib();
        $this->datatable       = ControladorBase::Datatable_lib();
        $this->form_validation = static::Form_validation_lib();
        $this->model           = static::consumosmodel();
    }

    public function index()
    {

        if (!$this->auth->is_logged_in()) {
            $this->redirect("Auth", "index");
        } elseif ($this->auth->is_logged_in(FALSE)) {
            // logged in, not activated
            $this->redirect("Auth", "send_again");
        } else {
            $data['sedes'] = $this->model->get_sedes(); //reemplazar por sedes user, para usuario multisede.
            $data['list_live_kit'] = $this->model->get_list_live_kit($this->auth->get_sede_default(), null);
            $this->view("private/pages/Consumos", $data);
        }
    }

    public function mantenimiento_consumos()
    {

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


    public function calendar_kit()
    {

        $id = $this->input->GET('kit');
        $query = $this->model->get_info_day_kit_by_id($id);
        $data = array();
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $background = date('Y-m-d') == $value['start'] ? '#3498db' : '#6c757d';
                $data[] = array(
                    "title"         => 'Información ' . $id,
                    "start"          =>  $value['start'],
                    "description"    =>  $value['comentario'],
                    "backgroundColor" =>  $value['estado_dia'] == 1 ? $background : '#6c757d',
                    "borderColor"    => '#6c757d',
                    "allDay"         => true,
                    'extendedProps'  => array(
                        'id'             => $value['id_info_day_kit'],
                        'pruebas'        => $value['n_pruebas'],
                        'calibradores'   => $value['n_calibradores'],
                        'controles'      => $value['n_controles'],
                        'verificaciones' => $value['n_verificaciones'],
                        'diluciones' => $value['n_diluciones'],
                        'venc_equipos' => $value['venc_equipos'],
                        'start'          => $value['start'],
                        'estado'         => $value['start'] == date('Y-m-d') ? '1' : '2'
                    )
                );
            }
        }

        echo json_encode($data);
    }


    public function search_kit()
    {

        $search  = $this->input->POST('search_data');
        $query   = $this->model->get_autocomplete_kit_live($search);
        $query2  = $this->model->get_autocomplete_kit($search);
        $estado = null;
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $estado = $value['estado'];
                $color  = $value['estado'] == 1 ? 'btn-outline-success' : 'btn-outline-danger'; ?>
                <a class="dropdown-item" onclick="update_kit_live('<?= $value['id_info_kit'] ?>', '<?= $estado ?>')" style="font-size: 1rem;" href="javascript:void(0)">
                    <p class="m-0 p-0 w-100 btn <?= $color ?>"><b><?= $value['name_examen'] ?></b></p>
                </a>
            <?php }
        } elseif (!empty($query2)) {
            foreach ($query2 as $key => $value) { ?>
                <a class="dropdown-item" onclick="update_kit_live('<?= $value['id_info_kit'] ?>', 2)" style="font-size: 1rem;" href="javascript:void(0)">
                    <p class="m-0 p-0 w-100 btn btn-outline-primary"><b><?= $value['name_examen'] ?></b></p>
                </a>
            <?php }
        } else {
            echo '<li class="dropdown-item" onclick="kit_info()">
                    <span><em>No se encontraron resultados.</em></span>
                  <span class="btn btn-primary btn-sm float-right " title="Crear kit"><i class="fa fa-plus text-white"></i></span>
                </li>';
        }
    }


    public function consumos_modal()
    {

        $option        = $this->input->POST('id');
        $id_sede       = $this->input->POST('sede');
        $sedes         = $this->model->get_sedes();

        switch ($option) {
            case 1: //open kit modal;
                $id_live_day   = null;
                $id_info_kit   = $this->input->POST('id_info_kit');
                $result        = $this->model->get_costo_referencia_by_id($id_info_kit);
                $sede_default  = $this->model->get_sedes_prueba($id_info_kit); ?>
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">ABRIR KIT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_info_kit_live" method="POST">
                            <input type="hidden" name="id" value="<?= $id_live_day ?>">
                            <input type="hidden" name="id_info_kit" value="<?= $id_info_kit ?>">
                            <div class="form-group row">
                                <label for="inputcodigo" class="col-sm-6 col-form-label">Sede de la prueba</label>
                                <div class="col-sm-6">
                                    <?php if ($id_sede == 'all') { ?>
                                        <select class="form-control" name="sede">
                                            <option value>Seleccione</option>
                                            <?php if (!empty($sedes)) {
                                                foreach ($sedes as $key => $value) { ?>
                                                    <option value="<?= $value['id_sedes'] ?>"> <?= $value['nombre'] ?> </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="help-block" style="color: red; font-size: 12px"></span>
                                    <?php  } else { ?>
                                        <input type="hidden" name="sede" value="<?= $id_sede ?>">
                                        <span><?= $this->model->get_name_sede_by_id(array('id_sedes' => $id_sede)) ?></span>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcodigo" class="col-sm-6 col-form-label">Código del kit</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="inputcodigo" name="codigo">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputreferencia" class="col-sm-6 col-form-label">Referencia</label>
                                <div class="col-sm-6">
                                    <?php if (!empty($result)) {
                                        foreach ($result as $key => $value) { ?>
                                            <input type="number" class="form-control" value="<?= $value['referencia'] ?>" id="inputreferencia" name="referencia">
                                    <?php }
                                    } else {
                                        echo " <input type='number' class='form-control' value='0' id='inputreferencia' name='referencia'>";
                                    } ?>
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputaperturta" class="col-sm-6 col-form-label">Fecha de apertura</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="inputaperturta" name="apertura" value="<?= date('YYYY-MM-DD') ?>" min="<?= date('Y-m-d') ?>">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputexpiracion" class="col-sm-6 col-form-label">Fecha de expiración</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="inputexpiracion" name="expiracion" min="<?= date('YYYY-MM-DD') ?>">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcosto" class="col-sm-6 col-form-label">Costo del Kit</label>
                                <div class="col-sm-6">
                                    <?php if (!empty($result)) {
                                        foreach ($result as $key => $value) { ?>
                                            <input type="number" value="<?= $value['costo'] ?>" class="form-control" id="inputcosto" name="costo">
                                    <?php }
                                    } else {
                                        echo " <input type='number' class='form-control' value='0' id='inputcosto' name='costo'>";
                                    } ?>
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputpruebas" class="col-sm-6 col-form-label">Nº Pruebas nominales</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="inputpruebas" name="pruebas" min="1">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputpruebas" class="col-sm-6 col-form-label">Pruebas Bonificadas</label>
                                <div class="col-sm-6">

                                    <!--    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="bonificable" value="1">-->
                                    <input type="number" class="form-control w-100" id="bonificable" name="bonificable" value="0">
                                    <!--   <label class="custom-control-label" for="customSwitch1"></label>-->

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputfabricante" class="col-sm-6 col-form-label">Fabricante</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="inputfabricante" name="fabricante" min="1">
                                    <span class="help-block" style="color: red; font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputdescripcion" class="col-sm-6 col-form-label">Descripción</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" id="inputdescripcion" placeholder="Ingrese una descripción" name="descripcion">
                                    </textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btnkit" onclick="save_kit_day()">Guardar Cambios</button>
                    </div>
                <?php break;
            case 2: //Crear, actualizar o mostrar información dependiente de su contenido;

                $today         = date('Y-m-d');
                $start         = $this->input->POST('start');
                $date_start    = $this->input->POST('date_start');

                $id_info_day   = $this->input->POST('id_info_day');
                $id_info_live  = $this->input->POST('id_info_live');
                $name          = $this->input->POST('name');
                $pruebas       = 0;
                $calibradores  = 0;
                $controles     = 0;
                $estado        = 0;
                $repeticiones  = 0;
                $diluciones  = 0;
                $venc_equipos  = 0;
                $comentario    = '';
                $readonly      = FALSE;
                $where         = array('start' => $start, 'id_info_live_kit' => $id_info_live);
                $eventday      = $this->model->get_event_by_day($where);

                if (!empty($eventday)) {

                    $id_info_day  = $eventday['id_info_day_kit'];
                    $pruebas      = $eventday['n_pruebas'];
                    $calibradores = $eventday['n_calibradores'];
                    $controles    = $eventday['n_controles'];
                    $repeticiones = $eventday['n_verificaciones'];
                    $diluciones = $eventday['n_diluciones'];
                    $venc_equipos = $eventday['venc_equipos'];
                    $comentario   = $eventday['comentario'];
                    $estado       = $eventday['estado'];
                    if ($estado  == 1 and $today == $eventday['start']) {
                        $readonly = FALSE;
                    } else {
                        $ajax_save_info_kit_day = TRUE;
                    }
                } ?>
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">Datos <?= $start ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_info_kit_day" method="POST">
                                <input type="hidden" name="id" value="<?= $id_info_day ?>">
                                <input type="hidden" name="id_info_live" value="<?= $id_info_live ?>">
                                <input type="hidden" name="name" value="<?= $name ?>">
                                <input type="hidden" name="start" value="<?= $start ?>">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <span id="comprobar_pruebas" class="text-danger text-bold"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputcalibradores" class="col-sm-8 col-form-label">Calibradores</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $calibradores . '</span>' : '<input type="number" name="calibradores" class="form-control" id="inputcalibradores" min="0" oninput="this.value = Math.abs(this.value)" value="' . $calibradores . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputcontroles" class="col-sm-8 col-form-label">Controles</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $controles . '</span>' : '<input type="number" name="controles" class="form-control" id="inputcontroles"  min="0" oninput="this.value = Math.abs(this.value)"  value="' . $controles . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputrepeticiones" class="col-sm-8 col-form-label">Repeticiones</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $repeticiones . '</span>' : '<input type="number" name="repeticiones" class="form-control" id="inputrepeticiones"  min="0" oninput="this.value = Math.abs(this.value)"  value="' . $repeticiones . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputrepeticiones" class="col-sm-8 col-form-label">Diluciones</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $diluciones . '</span>' : '<input type="number" name="diluciones" class="form-control" id="inputdiluciones"  min="0" oninput="this.value = Math.abs(this.value)"  value="' . $diluciones  . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputrepeticiones" class="col-sm-8 col-form-label">Vencido en Equipos</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $venc_equipos . '</span>' : '<input type="number" name="venc_equipos" class="form-control" id="inputvenc_equipos"  min="0" oninput="this.value = Math.abs(this.value)"  value="' . $venc_equipos  . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputpruebas" class="col-sm-8 col-form-label">Total de Pruebas</label>
                                    <div class="col-sm-4">
                                        <?= $readonly == TRUE ? '<span>' . $pruebas . '</span>' : '<input type="number" name="pruebas" class="form-control" id="inputpruebas"  min="0" oninput="this.value = Math.abs(this.value)"  value="' . $pruebas . '">'; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdescripcion" class="col-sm-6 col-form-label">Descripción</label>
                                    <?= $readonly == TRUE ? '<div class="col-sm-6"><span>' . $comentario . '</span></div>' : '<div class="col-sm-12"><textarea class="form-control" name="comentario" id="inputdescripcion" placeholder="Ingrese una descripción">' . $comentario . '</textarea></div>'; ?>
                                </div>
                            </form>
                        </div>
                        <?php if ($readonly == FALSE) { ?>
                            <div class="modal-footer justify-content-between">
                                <?php /* $id_info_day != '' ? '<button type="button" class="btn btn-warning" onclick="close_day(' . $id_info_day . ',' . $id_info_live . ',"' . $date_start . '")">Cerrar Día</button>' : ''; */ ?>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" id="btnkit" onclick="save_kit_day()">Guardar Cambios</button>
                            </div>
                        <?php } ?>
                    </div>
                <?php break;
            case 3: //create kit modal;
                $examenes = $this->model->get_list_examenes_no_kit(); ?>
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">EXAMEN POR SEDES</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <form id="form_info_kit" method="POST">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-6 col-form-label">Examen</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="inputEmail3" name="examen">
                                            <?php if (!empty($examenes)) {
                                                foreach ($examenes as $key => $value) { ?>
                                                    <option value="<?= $value['id_examenes'] ?>"> <?= $value['nombre_examen'] ?> </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="help-block" style="color: red; font-size: 12px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Sedes</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="sedes[]" multiple>
                                            <?php if (!empty($sedes)) {
                                                foreach ($sedes as $key => $value) { ?>
                                                    <option value="<?= $value['id_sedes'] ?>"> <?= $value['nombre'] ?> </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="help-block" style="color: red; font-size: 12px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdescripcion" class="col-sm-6 col-form-label">Descripción</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="comentario" id="inputdescripcion" placeholder="Ingrese una descripción"></textarea>
                                        <span class="help-block" style="color: red; font-size: 12px"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" id="btnkit" onclick="save_kit_day()">Guardar Cambios</button>
                        </div>
                    </div>
            <?php break;
        }
    }


    public function ajax_save_info_kit_day()
    {

        $this->_validate_info_day();

        $id            = $this->input->POST('id');
        $calibradores  = $this->input->POST('calibradores');
        $start  =        $this->input->POST('start');
        $controles     = $this->input->POST('controles');
        $repeticiones  = $this->input->POST('repeticiones');
        $diluciones  = $this->input->POST('diluciones');
        $venc_equipos  = $this->input->POST('venc_equipos');
        $pruebas       = $this->input->POST('pruebas');
        $comentario    = $this->input->POST('comentario');
        $id_info_live  = $this->input->POST('id_info_live');
        $name_examen   = $this->input->POST('name');
        $info          = $this->model->get_info_live_kit_by_id(array('id_info_live_kit' => $id_info_live));


        if (!empty($info)) {
            $data = array(
                'n_pruebas'        => $pruebas,
                'n_calibradores'   => $calibradores,
                'n_controles'      => $controles,
                'n_verificaciones' => $repeticiones,
                'n_diluciones' => $diluciones,
                'venc_equipos' => $venc_equipos,
                'comentario'       => $comentario,
                'start'            => $start,
                'id_info_live_kit' => $id_info_live,
                'estado'           => 1
            );

            if (!empty($id)) {
                $this->model->update_info_day_kit($data, array('id_info_day_kit' => $id));
            } else {
                $this->model->add_info_day_kit($data);
            }
            echo json_encode(array('status' => TRUE, 'start' => $info['date_start'], 'id' => $id_info_live, 'name' => $name_examen));
        }
    }

    private function _validate_info_day()
    {
        $this->form_validation->set_class_parent(self::class);
        $this->form_validation->set_rules('calibradores', 'Calibradores', 'required|is_natural|trim|xss_clean');
        $this->form_validation->set_rules('controles', 'Controles', 'required|is_natural|trim|xss_clean');
        $this->form_validation->set_rules('repeticiones', 'Repeticiones', 'required|is_natural|trim|xss_clean');
        $this->form_validation->set_rules('diluciones', 'Diluciones', 'required|is_natural|trim|xss_clean');
        $this->form_validation->set_rules('venc_equipos', 'Vencido en Equipos', 'required|is_natural|trim|xss_clean');
        $this->form_validation->set_rules('pruebas', 'Pruebas', 'required|trim|xss_clean');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|xss_clean');
        $this->form_validation->set_rules('comprobar_pruebas', 'Calibradores', 'callback_verifypruebas');

        $this->form_validation->set_error_delimiters('', '');

        $data['inputerror']    = array();
        $data['error_string']  = array();
        $data['status']        = TRUE;

        if (!$this->form_validation->run()) { // validation ok

            $data['inputerror'][]   = 'calibradores';
            $data['error_string'][] = $this->form_validation->error('calibradores');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'comprobar_pruebas';
            $data['error_string'][] = $this->form_validation->error('comprobar_pruebas');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'controles';
            $data['error_string'][] = $this->form_validation->error('controles');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'repeticiones';
            $data['error_string'][] = $this->form_validation->error('repeticiones');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'diluciones';
            $data['error_string'][] = $this->form_validation->error('diluciones');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'venc_equipos';
            $data['error_string'][] = $this->form_validation->error('venc_equipos');
            $data['status'] = FALSE;


            $data['inputerror'][]   = 'pruebas';
            $data['error_string'][] = $this->form_validation->error('pruebas');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'comentario';
            $data['error_string'][] = $this->form_validation->error('comentario');
            $data['status'] = FALSE;

            echo json_encode($data);
            exit;
        }
    }

    public function verifypruebas()
    {

        $id           = $this->input->POST('id');
        $id_live      = $this->input->POST('id_info_live');
        $pruebas      = $this->input->POST('pruebas');
        $calibradores = $this->input->POST('calibradores');
        $controles    = $this->input->POST('controles');
        $repeticiones = $this->input->POST('repeticiones');
        $diluciones = $this->input->POST('diluciones');
        $venc_equipos = $this->input->POST('venc_equipos');

        $total_input = intval($pruebas) + intval($calibradores) +  intval($controles) + intval($repeticiones) + intval($venc_equipos);

        $info  = $this->model->get_info_live_kit_by_id(array('id_info_live_kit' => $id_live));
        $query = $this->model->get_consolidados_by_info_live_kit($id_live);

        if (!empty($query) & !empty($info)) {
            if (is_array($query) & is_array($info)) {
                $n_pruebas       = $query[0]['n_pruebas'];
                $n_calibradores  = $query[0]['n_calibradores'];
                $n_controles     = $query[0]['n_controles'];
                $n_repeticiones  = $query[0]['n_repeticiones'];
                $n_diluciones  = $query[0]['n_diluciones'];
                $venc_equipos  = $query[0]['venc_equipos'];
                $total           = $n_pruebas + $n_calibradores +  $n_controles + $n_repeticiones + $n_diluciones + $venc_equipos;
                $nominales       = $info['pruebas_permitidas'];
                //existe cuando el dia es una actualización de datos
                if (!empty($id)) {
                    $query_day       = $this->model->get_event_by_day(array('id_info_day_kit' => $id));
                    if (!empty($query_day)) {
                        $total_day = $query_day['n_pruebas'] + $query_day['n_calibradores'] + $query_day['n_controles'] + $query_day['n_verificaciones'] + $query_day['n_diluciones'] + $query_day['venc_equipos'];
                        $consolidado = $total - $total_day + $total_input;
                    }
                } else {
                    $consolidado     = $total + $total_input;
                }

                if ($consolidado <= $nominales) {
                    return array('result' => TRUE);
                } else {
                    return array(
                        'result' => FALSE,
                        'message' => 'El número de pruebas ingresadas debe ser menor o igual al número de pruebas nominales del kit.'
                    );
                }
            }
        }
    }


    public function ajax_save_info_live()
    {

        $this->_validate_info_live();

        $id                   = $this->input->POST('id');
        $id_info_kit          = $this->input->POST('id_info_kit'); //id del info_kit 
        $sede                 = $this->auth->get_sede_default() == 'all' ? $this->auth->get_sede_default() :  $this->input->POST('sede');
        $codigo               = $this->input->POST('codigo');
        $referencia_interna   = $this->input->POST('referencia');
        $apertura             = $this->input->POST('apertura');
        $expiracion           = $this->input->POST('expiracion');
        $costo                = $this->input->POST('costo');
        $pruebas_permitidas   = $this->input->POST('pruebas');
        $fabricante           = $this->input->POST('fabricante');
        $bonificable          = $this->input->POST('bonificable');
        $descripcion          = $this->input->POST('descripcion');

        $data = array(
            'id_info_kit'             => $id_info_kit,
            'codigo'                  => $codigo,
            'referencia_interna'      => $referencia_interna,
            'date_start'              => $apertura,
            'date_expiration'         => $expiracion,
            'estado'                  => 1,
            'costo'                   => $costo,
            'pruebas_permitidas'      => $pruebas_permitidas,
            'bonificables'            => $bonificable, //se establecen como controles y calibradores adicionales Costo 0
            'comentario'              => $descripcion,
            'fabricante'              => $fabricante,
            'id_sedes'                => $sede

        );

        if (!empty($id)) {
            $this->model->update_info_live_kit($data, array('id_info_live_kit' => $id));
        } else {
            $this->model->add_info_live_kit($data);
        }
        echo json_encode(array('status' => TRUE));
    }

    private function _validate_info_live()
    {

        if ($this->auth->get_sede_default() == 'all') {
            $this->form_validation->set_rules('sede', 'sede', 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('codigo', 'código', 'trim|required|xss_clean');
        $this->form_validation->set_rules('referencia', 'Referencia Interna', 'trim|required|xss_clean');
        $this->form_validation->set_rules('apertura', 'Fecha de apertura', 'trim|required|xss_clean');
        $this->form_validation->set_rules('expiracion', 'Fecha de expiración', 'trim|required|xss_clean');
        $this->form_validation->set_rules('costo', 'Costo del Kit', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pruebas', 'Pruebas Nominales', 'is_natural_no_zero|trim|required|xss_clean');
        $this->form_validation->set_rules('bonificables', 'Pruebas Bonificacbles', 'trim|xss_clean');
        $this->form_validation->set_rules('fabricante', 'Fabricante', 'trim|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('', '');

        $data['inputerror']    = array();
        $data['error_string']  = array();
        $data['status']        = TRUE;

        if (!$this->form_validation->run()) { // validation ok

            if ($this->auth->get_sede_default() == 'all') {
                $data['inputerror'][]   = 'sede';
                $data['error_string'][] = $this->form_validation->error('sede');
                $data['status']         = FALSE;
            }

            $data['inputerror'][]   = 'codigo';
            $data['error_string'][] = $this->form_validation->error('codigo');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'referencia';
            $data['error_string'][] = $this->form_validation->error('referencia');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'apertura';
            $data['error_string'][] = $this->form_validation->error('apertura');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'expiracion';
            $data['error_string'][] = $this->form_validation->error('expiracion');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'costo';
            $data['error_string'][] = $this->form_validation->error('costo');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'fabricante';
            $data['error_string'][] = $this->form_validation->error('fabricante');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'pruebas';
            $data['error_string'][] = $this->form_validation->error('pruebas');
            $data['status'] = FALSE;


            echo json_encode($data);
            exit;
        }
    }


    public function ajax_save_info_kit()
    {
        $this->_validate_info_kit();

        $id_examen    = $this->input->POST('examen'); //id del info_kit 
        $sedes        = $this->input->POST('sedes'); //id del info_kit 
        $descripcion  = $this->input->POST('descripcion');
        $info         = $this->model->get_examen_by_id(array('id_examenes' => $id_examen));

        if (!empty($info)) {

            if (!empty($sedes) & is_array($sedes)) {

                $data = array(
                    'id_examenes'      => $info['id_examenes'],
                    'descripcion'      => $descripcion,
                    'name_examen'      => $info['nombre_examen'],
                    'codigo_cups'      => $info['codigo_cups'],
                    'fecha'            => date('Y-m-s'),
                    'estado'           => 1
                );
                $insert_id = $this->model->add_info_kit($data);

                foreach ($sedes as $key => $value) {
                    $datas = array('info_kit_id_info_kit' => $insert_id, 'sedes_id_sedes' => $value);
                    $this->model->add_info_kit_has_sedes($datas);
                }
            }

            echo json_encode(array('status' => TRUE));
        }
    }

    private function _validate_info_kit()
    {

        //$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('examen', 'examen', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sedes[]', 'sedes', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('', '');

        $data['inputerror']    = array();
        $data['error_string']  = array();
        $data['status']        = TRUE;

        if (!$this->form_validation->run()) { // validation ok


            $data['inputerror'][]   = 'examen';
            $data['error_string'][] = $this->form_validation->error('examen');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'sedes[]';
            $data['error_string'][] = $this->form_validation->error('sedes[]');
            $data['status'] = FALSE;

            $data['inputerror'][]   = 'descripcion';
            $data['error_string'][] = $this->form_validation->error('descripcion');
            $data['status'] = FALSE;


            echo json_encode($data);
            exit;
        }
    }

    public function close_kit()
    {
        $fechaActual = date('Y-m-d'); // Formato: Año-Mes-Día (por ejemplo, 2023-09-21)
        $id = $this->input->POST('id');
        $this->model->update_fecha_expiration($fechaActual, $id);

        $this->model->update_info_live_kit(array('estado' => 2), array('id_info_live_kit' => $id));
        echo json_encode(array('status' => TRUE));
    }

    public function close_day()
    {


        $id = $this->input->POST('id');

        $this->model->update_info_day_kit(array('estado' => 2), array('id_info_day_kit' => $id));
        echo json_encode(array('status' => TRUE));
    }

    public function lits_kit_history()
    {

        // Reading value
        $no              = empty($_POST['start']) ? 0 : $_POST['start'];
        $draw            = empty($_POST['draw']) ? NULL : $_POST['draw'];
        $row             = empty($_POST['start']) ? NULL : $_POST['start'];
        $rowperpage      = empty($_POST['length']) ? NULL : $_POST['length']; // Rows display per page
        $columnIndex     = empty($_POST['order'][0]['column']) ? NULL : $_POST['order'][0]['column']; // Column index
        $columnName      = empty($_POST['columns'][$columnIndex]['data']) ? 'ilk.estado' : $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = empty($_POST['order'][0]['dir']) ? 'asc' : $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = empty($_POST['search']['value']) ? NULL : $_POST['search']['value']; // Search value
        $id_sede         = $this->input->GET('id');

        $data = array(
            'draw'            => $draw,
            'row'             => $row,
            'rowperpage'      => $rowperpage,
            'columnName'      => $columnName,
            'columnSortOrder' => $columnSortOrder,
            'searchValue'     => $searchValue,
            'id_sede'         => $id_sede
        );


        $query = $this->model->get_table_info_live_kit($data);
        $data = array();
        foreach ($query['data'] as $kit_live) {

            $close_kit  = '';
            $edit_kit   = '';
            $estado_kit = '';

            $consolidados = $this->model->get_consolidados_by_info_live_kit($kit_live['id_info_live_kit']);

            if ($kit_live['estado'] == 1) {
                if ($kit_live['date_expiration'] < date('Y-m-d')) {
                    $estado_kit = '<span class="badge badge-warning d-flex">Expirado</span>';
                } else {
                    $estado_kit  = '<span class="badge badge-success d-flex">Abierto</span>';
                    $edit_kit    = '<button type="button" class="btn btn-info btn-sm" onclick="show_kit_live(' . $kit_live['id_info_live_kit'] . ',' . $kit_live['estado'] . ',\'' . $kit_live['date_start'] . '\',' . '\'CONSUMO DE ' . $kit_live['name_examen'] . '\')">Editar</button>';
                }
            } else {
                $estado_kit  = '<span class="badge badge-danger d-flex">Cerrado</span>';
            }

            $no++;
            $row = array();
           
            $row[] = $kit_live['sede'];
            $row[] = '<b>' . $kit_live['referencia_interna'] . '</b>';
            $row[] = $kit_live['name_examen'];
            $row[] = $kit_live['date_start'];
            $row[] = $kit_live['date_expiration'];
            $row[] = $estado_kit;
            $row[] = !empty($consolidados[0]['n_pruebas']) ? $consolidados[0]['n_pruebas'] : 0;
            $row[] = $consolidados[0]['n_pruebas'] > 0 ?  round(($consolidados[0]['n_pruebas'] / $kit_live['pruebas_permitidas'] * 100), 2) . ' %' : '0 %';
            $row[] = '<div class="btn-group m-0 p-0 d-flex" role="group" aria-label="Basic example">' . $edit_kit . '
                        <button type="button" class="btn btn-secondary btn-sm" onclick="consolidados_info_live_kit(' . $kit_live['id_info_live_kit'] . ')">Ver</button>' . $close_kit . '
                      </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $query['recordsTotal'],
            "recordsFiltered" => $query['recordsFiltered'],
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function consolidado_info_live_kit_by_id()
    {

        $id    = $this->input->POST('id'); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $this->get_consolidado_info_live_kit_by_id($id); ?>
                </div>
            </div>
            <?php
        }


        public function show_consolidado_info_live_kit_by_id()
        {
            $id    = $this->input->POST('id');
            $this->get_consolidado_info_live_kit_by_id($id);
        }

        public function get_list_info_live_kit()
        {
            $pint = $this->input->get('pint');
            $id = $this->input->get('id');
         
            $list_live_kit = $this->model->get_list_live_kit($id, $pint);
            if (!empty($list_live_kit)) {
                foreach ($list_live_kit as $key => $value) {
                    if ($value['date_expiration'] < date('Y-m-d')) {
                        $estado = 3;
                        $color = 'btn-warning';
                    } else {
                        $estado  = $value['estado'];
                        $color   = 'btn-secondary';
                    }
                    $date_start     = $value['date_start'];
                    $datediff       = strtotime($value['date_expiration']) - time();
                    $day_expiration = round($datediff / (60 * 60 * 24));
                    $costo_inicial  = $value['costo'];
                    $n_nominales    = $value['pruebas_nominales'];
                    $bonificables   = $value['bonificables'];
                    $fabricante   = $value['fabricante'];
                    $tooltip = 'data-toggle="tooltip" data-placement="top" title="faltan ' . abs($day_expiration) . ' dias para la expiración de este kit"';
                    if ($day_expiration > 100) {
                        $day_expiration = '<i class="badge badge-pill badge-success" ' . $tooltip . '> + 100 </i>';
                    } elseif ($day_expiration < -1) {
                        $tooltip        = 'data-toggle="tooltip" data-placement="top" title="Este kit expiro hace ' . abs($day_expiration) . ' dias"';
                        $day_expiration =  '<i class="badge badge-pill badge-danger" ' . $tooltip . '>' . abs($day_expiration) . '</i>';
                    } else {
                        $day_expiration = '<i class="badge badge-pill badge-warning" ' . $tooltip . '>' . abs($day_expiration) . '</i>';
                    }
                    $id             = $value['id_info_live_kit']; ?>
                    <div class="card m-0 mb-1">
                        <div class="btn <?= $color ?> d-flex justify-content-between" onclick="kit_live(<?= $id ?>)" id="heading<?= $id ?>" data-id="<?= $id ?>" data-status="<?= $estado ?>" data-start="<?= $date_start ?>" data-name="<?= $value['name_examen'] ?>">
                            <span><?= $day_expiration ?>&nbsp;&nbsp;</span>
                            <?= $value['name_examen'] ?>
                            <buttom class="badge btn collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $id ?>" aria-expanded="true" aria-controls="collapse<?= $id ?>" onclick="show_info_live_kit(<?= $id ?>, <?= $estado ?>)">
                                <i class="fa fa-eye fa-2x text-black" title="Información de la prueba">&nbsp;</i>
                            </buttom>
                        </div>
                        <div id="collapse<?= $id ?>" class="collapse" aria-labelledby="heading<?= $id ?>" data-parent="#list_kit_open">
                        </div>
                    </div>
                <?php }
            } else { ?> <p>
                No existen pruebas disponibles para su consumo en este momento.</p> <?php }
                                                                                }

                                                                                public function get_consolidado_info_live_kit_by_id($id)
                                                                                {

                                                                                    $value = $this->model->get_live_kit_by_id($id);
                                                                                    if (!empty($value)) {
                                                                                        if ($value['date_expiration'] < date('Y-m-d')) {
                                                                                            $estado = 3;
                                                                                            $color = 'btn-warning';
                                                                                        } else {
                                                                                            $estado  = $value['estado'];
                                                                                            $color   = 'btn-secondary';
                                                                                        }
                                                                                        $date_start     = $value['date_start'];
                                                                                        $datediff       = strtotime($value['date_expiration']) - time();
                                                                                        $day_expiration = round($datediff / (60 * 60 * 24));
                                                                                        $costo_inicial  = $value['costo'];
                                                                                        $n_nominales    = $value['pruebas_permitidas'];
                                                                                        $bonificables   = $value['bonificables'];
                                                                                        $fabricante   = $value['fabricante'];
                                                                                        $tooltip = 'data-toggle="tooltip" data-placement="top" title="faltan ' . abs($day_expiration) . ' dias para la expiración de este kit"';
                                                                                        if ($day_expiration > 100) {
                                                                                            $day_expiration = '<i class="badge badge-pill badge-success" ' . $tooltip . '> + 100 </i>';
                                                                                        } elseif ($day_expiration < -1) {
                                                                                            $tooltip        = 'data-toggle="tooltip" data-placement="top" title="Este kit expiro hace ' . abs($day_expiration) . ' dias"';
                                                                                            $day_expiration =  '<i class="badge badge-pill badge-danger" ' . $tooltip . '>' . abs($day_expiration) . '</i>';
                                                                                        } else {
                                                                                            $day_expiration = '<i class="badge badge-pill badge-warning" ' . $tooltip . '>' . abs($day_expiration) . '</i>';
                                                                                        } ?>
                <div class="card-body">
                    <h5 class="text-center text-bold">Información General</h5>
                    <p><b>Sede:</b> <span class="float-right"><?= $value['sede'] ?></span></p>
                    <p><b>Nombre:</b> <span class="float-right"><?= $value['name_examen'] ?></span></p>
                    <p><b>Codigo Cups:</b> <span class="float-right"><?= $value['codigo_cups'] ?></span></p>
                    <p><b>Fecha Apertura:</b> <span class="float-right"><?= $value['date_start'] ?></span></p>
                    <p><b>Fecha Expiración:</b><span class="float-right"> <?= $value['date_expiration'] ?></span></p>
                    <p><b>Fecha Cierre:</b><span class="float-right"> <?= $value['end_live'] ?></span></p>
                    <p><b>Costo del Kit:</b><span class="float-right"> <?= $costo_inicial ?></span></p>
                    <p><b>Estado: &nbsp;</b><span class="float-right"><?php if ($estado == 1) {
                                                                                            echo '<span class="badge badge-success">Abierto</span>';
                                                                                        } elseif ($estado == 3) {
                                                                                            echo '<span class="badge badge-warning">Expirado</span>';
                                                                                        } else {
                                                                                            echo '<span class="badge badge-danger">Cerrado</span>';
                                                                                        } ?></span></p>

                    <?php $consolidados = $this->model->get_consolidados_by_info_live_kit($id);

                                                                                        $n_pruebas       = $consolidados[0]['n_pruebas'];
                                                                                        $n_calibradores  = $consolidados[0]['n_calibradores'];
                                                                                        $n_controles     = $consolidados[0]['n_controles'];
                                                                                        $n_repeticiones  = $consolidados[0]['n_repeticiones'];
                                                                                        $n_diluciones  = $consolidados[0]['n_diluciones'];
                                                                                        $venc_equipos  = $consolidados[0]['venc_equipos'];
                                                                                        $statusbono       =  $bonificables == 1 ? $n_calibradores + $n_controles : 0;
                                                                                        $n_facturables    =  $n_pruebas; //cruce posterior con contabilidad
                                                                                        $costo_compra     =  $costo_inicial / $n_nominales;
                                                                                        $pruebas_totales  =  $n_facturables > 0 ? $n_facturables + $n_repeticiones + $statusbono : 0;
                                                                                        $costo_esperado   =  $costo_compra * $pruebas_totales;
                                                                                        $costo_proyectado =  $costo_compra * $n_facturables;
                                                                                        $diferencia_costo =  $costo_esperado -  $costo_proyectado;
                                                                                        $dispercion       =  $n_facturables > 0 ? $diferencia_costo / $n_facturables : 0;
                                                                                        $costo_asignado   =  $costo_compra + $dispercion;
                                                                                        $costo_compra__   =  $costo_asignado * $n_nominales;
                                                                                        $rendimiento      =  ($n_facturables * 100) / $n_nominales;

                                                                                        if (!empty($consolidados)) { ?>
                        <h5 class="text-center text-bold">Consolidados</h5>
                        <?php $sumtotal =   $consolidados[0]['n_calibradores'] +  $consolidados[0]['n_controles'] + $consolidados[0]['n_repeticiones'] + $consolidados[0]['n_diluciones'] + $consolidados[0]['venc_equipos'] ?>
                        <?php $bonifinfo = $bonificables != 1 ? 'class="text-danger" title="Los controles y los calibradores no se tienen en cuenta en el costo por prueba."' : '' ?>
                        <p><b>Nº Pruebas Nominales:</b> <span class="float-right"><?= $n_nominales; ?></span></p>
                        <p <?= $bonifinfo ?>><b>Nº calibradores:</b><span class="float-right"><?= $n_calibradores ?></span></p>
                        <p <?= $bonifinfo ?>><b>Nº controles:</b><span class="float-right"><?= $n_controles ?> </span></p>
                        <p <?= $bonifinfo ?>><b>Nº repeticiones:</b> <span class="float-right"><?= $n_repeticiones ?></span></p>
                        <p <?= $bonifinfo ?>><b>Nº Diluciones:</b> <span class="float-right"><?= $n_diluciones ?></span></p>
                        <p <?= $bonifinfo ?>><b>Vencido en Equipos:</b> <span class="float-right"><?= $venc_equipos ?></span></p>
                        <p <?= $bonifinfo ?>><b> Total Pruebas:</b> <span class="float-right"><?= $sumtotal ?></span> </p>
                        <p><b>Pruebas Facturables:</b> <span class="float-right"><?= $n_facturables ?></span> </p>
                        <p><b>Costo real del kit:</b> <span class="float-right">$ <?= round($costo_compra__, 0) ?></span> </p>
                        <p><b>Costo por prueba:</b> <span class="float-right">$ <?= round($costo_asignado, 0) ?></span> </p>
                        <p><b>Rendimiento:</b> <span class="float-right"><?= round($rendimiento, 0) ?> %</span> </p>
                    <?php }

                                                                                        echo ($estado == 1 ||  $estado == 3) ? '<div class="btn-group d-flex" role="group" aria-label="Basic example">
                                                                    <button type="button" class="btn btn-danger btn-sm btn-block" onclick="close_kit(' . $id . ')">
                                                                        <b>CERRAR KIT<i class="fa fa-lock float-right"></i></b>
                                                                    </button>
                                                                </div>' : ''; ?>
                </div>

    <?php }
                                                                                }


                                                                                public function change_user_sede()
                                                                                {

                                                                                    $id = $this->input->POST('id');
                                                                                    $this->auth->change_data_user(array('id_sede' => $id));
                                                                                    echo json_encode(array('status' => TRUE));
                                                                                }

                                                                                public function list_examenes_costeados()
                                                                                {

                                                                                    // Reading value
                                                                                    $no              = empty($_POST['start']) ? 0 : $_POST['start'];
                                                                                    $draw            = empty($_POST['draw']) ? NULL : $_POST['draw'];
                                                                                    $row             = empty($_POST['start']) ? NULL : $_POST['start'];
                                                                                    $rowperpage      = empty($_POST['length']) ? NULL : $_POST['length']; // Rows display per page
                                                                                    $columnIndex     = empty($_POST['order'][0]['column']) ? NULL : $_POST['order'][0]['column']; // Column index
                                                                                    $columnName      = empty($_POST['columns'][$columnIndex]['data']) ? 'name_examen' : $_POST['columns'][$columnIndex]['data']; // Column name
                                                                                    $columnSortOrder = empty($_POST['order'][0]['dir']) ? 'asc' : $_POST['order'][0]['dir']; // asc or desc
                                                                                    $searchValue     = empty($_POST['search']['value']) ? NULL : $_POST['search']['value']; // Search value

                                                                                    $data = array(
                                                                                        'draw'            => $draw,
                                                                                        'row'             => $row,
                                                                                        'rowperpage'      => $rowperpage,
                                                                                        'columnName'      => $columnName,
                                                                                        'columnSortOrder' => $columnSortOrder,
                                                                                        'searchValue'     => $searchValue,
                                                                                    );

                                                                                    $query = $this->model->get_table_examenes_costeados($data);

                                                                                    $data = array();

                                                                                    foreach ($query['data'] as $proveedores) {
                                                                                        $no++;
                                                                                        $row = array();
                                                                                        $row[] = $no;
                                                                                        $row[] = $proveedores['codigo_cups'];
                                                                                        $row[] = $proveedores['name_examen'];
                                                                                        $row[] = '';
                                                                                        $row[] = '';
                                                                                        $row[] = 'Acciones';
                                                                                        $data[] = $row;
                                                                                    }

                                                                                    $output = array(
                                                                                        "draw" => $_POST['draw'],
                                                                                        "recordsTotal" => $query['recordsTotal'],
                                                                                        "recordsFiltered" => $query['recordsFiltered'],
                                                                                        "data" => $data,
                                                                                    );
                                                                                    //output to json format
                                                                                    echo json_encode($output);
                                                                                }
                                                                            } //fin clase UsuariosController  
                                                                        
    ?>