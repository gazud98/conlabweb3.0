<?php 

/**
 * Datatable_lib
 * Authentication library
 *
 * @package		Auth_lib
 * @author		Jesús Ariza (http://jesusarizareyes@gmail.com/)
 * @version		1.0
 */

class Datatable_lib extends ControladorBase{
    private $DatatableModel;

	function __construct(){
		parent::__construct(); 
		$this->DatatableModel  = static::DatatableModel();
		$this->form_validation = static::Form_validation_lib();
	}

	public function list_table($data = array()){

		$table           = $data['table'];
        $dbdefault       = !empty($data['dbdefault'])? $data['dbdefault'].'.': dblab;
		$id              = 'id_'.$table; 
		$search          = $data['search'];
		$campos          = $data['campos'];
		$accion          = $data['accion'];
		$select          = $data['select'] == FALSE ? '*': $data['select'];
		$order           = empty($data['order'])? 'asc' : $data['order'];
        $no              = empty($_POST['start']) ? 0 : $_POST['start'];
        $draw            = empty($_POST['draw']) ? NULL : $_POST['draw'];
        $row             = empty($_POST['start']) ? NULL : $_POST['start'];
        $rowperpage      = empty($_POST['length']) ? NULL : $_POST['length']; // Rows display per page
        $columnIndex     = empty($_POST['order'][0]['column']) ? NULL : $_POST['order'][0]['column']; // Column index
		$searchValue     = empty($_POST['search']['value']) ? NULL : $_POST['search']['value']; // Search value
        $columnName      = empty($_POST['columns'][$columnIndex]['data']) ? '1' : $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = empty($_POST['order'][0]['dir']) ? $order : $_POST['order'][0]['dir']; // asc or desc
   
        $data = array(
						'draw'            => $draw,
						'row'             => $row,
						'rowperpage'      => $rowperpage,
						'columnName'      => $columnName,
						'columnSortOrder' => $columnSortOrder,
						'searchValue'     => $searchValue,
						'table'           => $table,
                        'dbdefault'       => $dbdefault,
						'campos'          => $campos,
						'searchs'         => $search, 
						'select'          => $select,
                    );

        $query = $this->DatatableModel->get_table($data);

		$data = array();
		if (!empty($query['data'])) {
			foreach ($query['data'] as $key) {
				$no++;
				$row = array();
				$row[]  = $no;
				foreach ($campos as $camp){ $row[] = $this->_camp_option(empty($camp['type'])? NULL: $camp['type'], $key[$camp['name']]); }
				$row[] = $this->_camp_option(1,  $accion, $key['id']);
				$data[] = $row;
			}
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $query['recordsTotal'],
            "recordsFiltered" => $query['recordsFiltered'],
            "data" => $data,
        );

        //output to json format
        return json_encode($output);
    }


	private function _camp_option($tipo, $accion, $id = ''){
		$value = '';
		$vars = '';
		switch ($tipo) {
			case 1: if (is_array($accion)) { 
						$value.= '<div class="btn-group m-0 p-0 d-flex" role="group">';
							foreach ($accion as $key){ 
								    if (!empty($key['vars'])){ $vars = str_replace('{id}', $id, $key['vars']); }
								    $value.= '<'.$key['objeto'].' '.$key['prop'].' class="'.$key['class'].'" '.$key['event'].'="'.$key['event_name'].'('.$vars.')">
								                        <i class="'.$key['icon'].'"></i> '.$key['title'].' 
											  </'.$key['objeto'].'>'; 
					        } //end foreach
						$value.= $key['objeto']!='img'? '</div>' : '';
					}
		    break; 
            case 2:
                $value.= '<div class="btn-group m-0 p-0 d-flex" role="group">';
                if ($accion==1){ $value.= '<button class="btn btn-success btn-sm w-20"> Activo </buttom>';
                }else{           $value.= '<button class="btn btn-danger btn-sm "> Inactivo </buttom>';  }
                $value.= '</div>';
            break;
			default: $value = $accion;
		}
		return $value;
	}

	public function get_table_by_id($table, $id, $dbdefault = dblab){

		return $this->DatatableModel->get_table_by_id($table, $id, $dbdefault);
		
    }


    public  function _validate($campos, $type =  FALSE){
    
        $type == TRUE ? $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean'): $this->form_validation->set_rules('id', 'id', 'trim|xss_clean');
        if(!empty($campos)){  foreach ($campos as $cam) { $this->form_validation->set_rules( $cam['name'], 'Descripción', $cam['rules']); } }
        
        $this->form_validation->set_error_delimiters('', '');

        $data['inputerror']    = array();
        $data['error_string']  = array();
        $data['status']        = TRUE;

        if (!$this->form_validation->run()) { // validation ok

            if($type == TRUE){ 
                $data['inputerror'][]   = 'id';
                $data['error_string'][] = $this->form_validation->error('id');
                $data['status'] = FALSE;
            }

            if(!empty($campos)){  
                 foreach ($campos as $camp) { 
                    $data['inputerror'][]   = $camp['name'];
                    $data['error_string'][] = $this->form_validation->error($camp['name']);
                    $data['status'] = FALSE;
                 }
            }

            echo json_encode($data);
            exit;
        }
    }


	public function _creator_form($table, $title, $campos, $id = FALSE, $dbdefault){

        $data = $id!=FALSE? $this->DatatableModel->get_table_by_id($table, $id, $dbdefault) : array(); ?>

        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_<?=$table?>" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="hidden" name="table" value="<?=$table?>">
                    <div class="row">
                        <?php foreach ($campos as $key) {
                            switch ($key['type']) {

                                case 'input': ?>
                                    <div class="<?= empty($key['colclass'])? 'col-lg-12 col-md-12' : $key['colclass']?>">
                                        <div class="<?= empty($key['groupclass'])? 'form-group' : $key['groupclass']?>">
                                            <label><b><?=$key['title']?></b></label>
                                            <input type="<?= !empty($key['inputype'])? $key['inputype'] : 'text'?>" class="form-control <?= !empty($key['class'])? $key['class'] : ''?>" name="<?= !empty($key['name'])? $key['name']: ''?>" id="<?= !empty($key['name'])? $key['name'] : ''?>" placeholder="<?= !empty($key['placeholder'])? $key['placeholder'] : ''?>" value="<?php  if($id!=FALSE) echo $key['inputype']=='month'? date('Y-m', strtotime($data[$key['name']])) : $data[$key['name']]?>" <?= !empty($key['prop'])? $key['prop'] : ''?>>
                                            <span class="help-block" style="color: red; font-size: 12px"></span>
                                        </div>
                                    </div>
                                <?php break;
                                
                                case 'textarea':?>
                                    <div class="<?= empty($key['colclass'])? 'col-lg-12 col-md-12' : $key['colclass']?>">
                                        <div class="<?= empty($key['groupclass'])? 'form-group' : $key['groupclass']?>">
                                            <label><b><?=$key['title']?></b></label>
                                            <textarea class="form-control <?= !empty($key['class'])? $key['class'] : ''?>" rows="<?= !empty($key['textrows'])? $key['textrows'] : ''?>" name="<?= !empty($key['name'])? $key['name']: ''?>" id="<?= !empty($key['name'])? $key['name'] : ''?>" placeholder="<?= !empty($key['placeholder'])? $key['placeholder'] : ''?>" <?= !empty($key['prop'])? $key['prop'] : ''?>><?=$id!=FALSE? $data[$key['name']] : '';?></textarea>
                                            <span class="help-block" style="color: red; font-size: 12px"></span>
                                        </div>
                                    </div>
                                <?php break;
                                case 'select':  $datos = $key['datasql'] == NULL? '' : $this->DatatableModel->get_list_data_by_id($key['datasql']);
								     if(isset($datos)){ ?>
										<div class="<?= empty($key['colclass'])? 'col-lg-12 col-md-12' : $key['colclass']?>">
											<div class="<?= empty($key['groupclass'])? 'form-group' : $key['groupclass']?>">
												<label><b><?=$key['title']?></b></label>
												<select class="form-control <?= !empty($key['class'])? $key['class'] : ''?>" name="<?= !empty($key['name'])? $key['name'] : ''?>" id="<?= !empty($key['name'])? $key['name'] : ''?>" <?= !empty($key['prop'])? $key['prop'] : ''?>>
												 	<?php foreach ($datos as $keye) { ?>
														<option value="<?=$keye['id']?>" <?php if(!empty($id)) echo $data[$key['name']]==$keye['id']? 'selected="selected"': ''?>><?=$keye['name']?></option>
													<?php } ?>
												</select>
												<span class="help-block" style="color: red; font-size: 12px"></span>
											</div>
										</div>
                                <?php } break;

                                case 'checkbox': ?>
                                    <div class="pt-5 <?= empty($key['colclass'])? 'col-lg-12 col-md-12' : $key['colclass']?>">
                                        <div class="<?= empty($key['groupclass'])? 'custom-control custom-switch' : $key['groupclass']?>">
                                            <input  class="custom-control-input <?= !empty($key['class'])? $key['class'] : ''?>" value="1" type="checkbox" name="<?= !empty($key['name'])? $key['name'] : ''?>" id="<?= !empty($key['name'])? $key['name'] : ''?>" <?= !empty($key['prop'])? $key['prop'] : ''?> <?php if($id != FALSE) echo $data[$key['name']] == 1? 'checked' : '';?>>
                                            <label class="custom-control-label" for="<?= !empty($key['name'])? $key['name'] : ''?>"><b><?=$key['title']?></b></label>
                                        </div>
                                    </div>
                                <?php  break;

                        } } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnkit" onclick="save('<?=$table?>')">Guardar Cambios</button>
            </div>
        </div> <?php //fin estructura modal dinamic     
    }


    public function get_data_table_by_id($table, $id){

        return $this->DatatableModel->get_data_table_by_id($table, $id);

    }


    public function get_list_data_by_id($sql){
           
        return $this->DatatableModel->get_list_data_by_id($sql);

    }


    public function option_form($table, $data, $option, $class){

        switch ($option) {

            case 1:
                $form  = $data['form_add'];
                $dbdefault = !empty($data['dbdefault'])? $data['dbdefault'].'.': dblab;
                if ($form != FALSE) {
                    if ($form['origin'] == 'auto') {
                        $title  = $form['title'];
                        $campos = !empty($form['campos']) ? $form['campos'] : array();
                        $this->_creator_form($table, $title, $campos, NULL, $dbdefault);
                    } elseif ($form['origin'] == 'manual') {
                        $title  = $form['title'];
                        $class = new $class;
                        call_user_func_array(array($class, $form['function']), array($table, $title));
                    }
                }
                break;

            case 2:
                $form = $data['form_edit'];
                $dbdefault = !empty($data['dbdefault'])? $data['dbdefault'].'.': dblab;
                $id   = $this->input->POST('id');
                if ($form != FALSE) {
                    if ($form['origin'] == 'auto') {
                        $title  = $form['title'];
                        $campos = !empty($form['campos']) ? $form['campos'] : array();
                        $this->_creator_form($table, $title, $campos, $id, $dbdefault);
                    }elseif($form['origin'] == 'manual') {
                        $title  = $form['title'];
                        $class = new  $class();
                        call_user_func_array(array($class, $form['function']), array($table, $title, $id));
                    }
                }
                break;

            case 3:
                $form = $data['form_external'];
                //construccion del modal a partir de un parametro tenido de form external
                echo 'En construción';
                break;

            default:
                $this->default_modal();
            break;
        }

    }

    private function default_modal(){

        echo 'modal visual solo información';
    }

    public function form_add($table, $data){

        $inputs = array();
        $dbdefault = dblab;
        if (!empty($data)) {
            if ($data['form_add'] != FALSE) {
                $campos = $data['form_add']['campos'];
                $dbdefault = !empty($data['dbdefault'])? $data['dbdefault'].'.': $dbdefault;
                $this->_validate($campos);
                if (!empty($campos)) {
                    foreach ($campos as $key) {
                        $inputs = array_merge($inputs, array($key['name'] => $this->input->post($key['name'])));
                    }
                }
            }
        }

        $this->ajax_add($table, $inputs, $dbdefault);

    }


    public function form_edit($table, $data, $id){

        $inputs = array();
        $dbdefault = dblab;
        if (!empty($data)) {
            if ($data['form_edit'] != FALSE) {
                $campos = $data['form_edit']['campos'];
                $dbdefault = !empty($data['dbdefault'])? $data['dbdefault'].'.': $dbdefault;
                $this->_validate($campos, true);
                if (!empty($campos)) {
                    foreach ($campos as $key) {
                        $inputs = array_merge($inputs, array($key['name'] => $this->input->post($key['name'])));
                    }
                }
            }
        }

        $where = array('id_' . $table => $id);
        $this->ajax_edit($table, $inputs,  $where, $dbdefault);

    }

    public function ajax_add($table, $data, $dbdefault){

        $this->DatatableModel->add_datatable($dbdefault.$table, $data);
        echo json_encode(array('status' => TRUE));
    }

    public function ajax_edit($table, $data, $where, $dbdefault){
        
        $this->DatatableModel->update_datatable($dbdefault.$table, $data, $where);
        echo json_encode(array('status' => TRUE));
    }
 
    public function ajax_delete($table, $where, $dbdefault = dblab){

        $this->DatatableModel->delete_datatable($dbdefault.$table, $where);
        echo json_encode(array('status' => TRUE));
    }


    public function get_data(){

        $id       = $this->input->POST('id');
        $table    = $this->input->POST('table');
        $campo    = $this->input->POST('campo');
        $selected = $this->input->POST('selected');
        $name     = $this->input->POST('name');
        $thisid   = $this->input->POST('thisid');

        $where = !empty($id)? array( $campo => $id): array(); 
        $data  = $this->get_data_table_by_id($table, $where);
        //print_r($data); exit;?>
        <option value="">Seleccione una opción</option>
        <?php if (!empty($data)){  
            foreach ($data as $key ) { ?>
                <option value="<?=$key[$thisid]?>" <?=$selected==$key[$thisid]? 'selected="selected"': '' ?>>
                    <?=$key[$name]?>
                </option>
        <?php } }
    }


}

