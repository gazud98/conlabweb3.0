<?php

require_once './core/system/ModeloBase.php';

class CostosModel extends ModeloBase
{

    public function __construct()
    {

        parent::__construct();
    }


    public function get_sedes()
    {

        $query       =   $this->conexioPDO->get("sedes");
        return $query;
    }


    public function get_sedes_prueba($id)
    {

        $query       =   $this->conexioPDO->getRecFrmQry("SELECT *
                                                                FROM sedes as se
                                                                INNER JOIN " . dblab . "info_kit_has_sedes as ihs ON (se.id_sedes = ihs.sedes_id_sedes) 
                                                                WHERE ihs.info_kit_id_info_kit = " . $id);

        return $query;
    }

    public function get_name_sede_by_id($where)
    {

        return  $this->conexioPDO->get_row(prefixdb . "_access.sedes", $where)['name'];
    }

    public function get_list_examenes_no_kit()
    {

        $query       =   $this->conexioPDO->getRecFrmQry("SELECT ex.nombre_examen, ex.id_examenes, ex.codigo_cups 
                                                                FROM " . dblab . "examenes as ex
                                                                WHERE ex.id_examenes NOT IN (SELECT id_examenes FROM " . dblab . "info_kit)  
                                                                and ex.estado = 1
                                                                ORDER BY ex.nombre_examen ASC");

        return $query;
    }

    public function get_examen_by_id($where)
    {

        $query       =   $this->conexioPDO->get_row(dblab . 'examenes', $where);
        return $query;
    }

    public function get_info_kits()
    {

        $query       =   $this->conexioPDO->getRecFrmQry("SELECT ex.nombre_examen, ex.id_examenes, ex.codigo_cups 
        FROM " . dblab . "examenes as ex
        WHERE  ex.estado = 1
        ORDER BY ex.nombre_examen ASC");

return $query;
    }

    function get_list_live_kit($where)
    {

        $where = $where == 'all' ? '' : 'AND ilk.id_sedes = ' . $where;

        $sql = "SELECT ik.name_examen, ilk.id_info_live_kit, ilk.estado, 
                            ik.codigo_cups, ilk.date_start, ilk.end_live, 
                            ilk.date_expiration, ilk.costo, ilk.pruebas_permitidas as 'pruebas_nominales',
                            ilk.bonificables
                        FROM " . dblab . "info_live_kit as ilk
                        INNER JOIN " . dblab . "info_kit as ik ON (ilk.id_info_kit = ik.id_info_kit)  
                        WHERE ilk.estado = 1 " . $where . " 
                        ORDER BY id_info_live_kit DESC";

        $query = $this->conexioPDO->getRecFrmQry($sql);
        return $query;
    }


    function get_live_kit_by_id($id)
    {

        $sql = "SELECT ik.name_examen, ilk.id_info_live_kit, ilk.estado, 
                           ik.codigo_cups, ilk.date_start, ilk.end_live, 
                           ilk.date_expiration, ilk.costo, ilk.pruebas_permitidas,
                           ilk.bonificables, se.name as sede
                    FROM " . dblab . "info_live_kit as ilk
                    INNER JOIN " . dblab . "info_kit as ik ON (ilk.id_info_kit = ik.id_info_kit) 
                    INNER JOIN sedes as se  ON (se.id_sedes = ilk.id_sedes)  
                    WHERE ilk.id_info_live_kit = " . $id;

        $query = $this->conexioPDO->query($sql);
        return $query;
    }

    public function get_autocomplete_kit_live($search_data)
    {
        $condition    =    'UPPER(ik.name_examen) LIKE UPPER("%' . $search_data . '%")';
        $query       =   $this->conexioPDO->getRecFrmQry("SELECT DISTINCT ik.name_examen, ik.id_info_kit, ilk.estado 
                                                                FROM " . dblab . "info_live_kit as ilk
                                                                INNER JOIN " . dblab . "info_kit as ik 
                                                                ON (ilk.id_info_kit = ik.id_info_kit) 
                                                                WHERE " . $condition . " AND ilk.id_info_kit NOT IN (SELECT DISTINCT id_info_kit FROM " . dblab . "info_live_kit  WHERE estado = 1) 
                                                                AND ilk.estado = 2 
                                                                ORDER BY ik.name_examen ASC");

        return $query;
    }

    public function get_autocomplete_kit($search_data)
    {

        $condition    =    'UPPER(ik.name_examen) LIKE UPPER("%' . $search_data . '%")';
        $query       =   $this->conexioPDO->getRecFrmQry("SELECT ik.name_examen, ik.id_info_kit 
                                                                FROM " . dblab . "info_kit as ik
                                                                WHERE " . $condition . " AND ik.id_info_kit NOT IN (SELECT id_info_kit FROM " . dblab . "info_live_kit) 
                                                                ORDER BY ik.id_info_kit DESC");

        return $query;
    }

    public function get_info_day_kit_by_id($id)
    {

        $query       =   $this->conexioPDO->getRecFrmQry("SELECT  ilk.id_info_live_kit,  
                                                                        ilk.estado, 
                                                                        ilk.date_start,
                                                                        ilk.date_expiration, 
                                                                        idk.id_info_day_kit,
                                                                        idk.start,
                                                                        idk.n_pruebas,
                                                                        idk.n_calibradores,
                                                                        idk.n_controles,
                                                                        idk.n_verificaciones,
                                                                        idk.comentario,
                                                                        idk.estado as 'estado_dia' 
                                                                FROM " . dblab . "info_live_kit as ilk
                                                                INNER JOIN " . dblab . "info_day_kit as idk 
                                                                ON (ilk.id_info_live_kit = idk.id_info_live_kit) 
                                                                WHERE idk.id_info_live_kit = " . $id);

        return $query;
    }


    public function get_info_live_kit_by_id($where)
    {
        $query  =  $this->conexioPDO->get_row(dblab . 'info_live_kit', $where);
        return  $query;
    }

    public function get_event_by_day($where)
    {
        $query  =  $this->conexioPDO->get_row(dblab . 'info_day_kit', $where);
        return  $query;
    }

    public function add_info_day_kit($data)
    {

        $query = $this->conexioPDO->insert(dblab . 'info_day_kit', $data);
        return  $query;
    }

    public function update_info_day_kit($data, $where = null)
    {
        $query = $this->conexioPDO->update(dblab . 'info_day_kit', $data, $where);
        return  $query;
    }

    public function add_info_live_kit($data)
    {

        $query = $this->conexioPDO->insert(dblab . 'info_live_kit', $data);
        return  $query;
    }

    public function update_info_live_kit($data, $where = null)
    {
        $query = $this->conexioPDO->update(dblab . 'info_live_kit', $data, $where);
        return  $query;
    }

    public function add_info_kit($data)
    {

        $query = $this->conexioPDO->insert(dblab . 'info_kit', $data);
        return  $this->conexioPDO->lastInsertId();
    }

    public function update_info_kit($data, $where = null)
    {
        $query = $this->conexioPDO->update(dblab . 'info_kit', $data, $where);
        return  $query;
    }

    public function add_info_kit_has_sedes($data)
    {

        $query = $this->conexioPDO->insert(dblab . 'info_kit_has_sedes', $data);
        return  $query;
    }

    public function get_consolidados_by_info_live_kit($id)
    {

        $query       =   $this->conexioPDO->getRecFrmQry("SELECT SUM(idk.n_pruebas) as 'n_pruebas', 
                                                                       SUM(idk.n_calibradores) as n_calibradores,
                                                                       SUM(idk.n_controles) as n_controles,
                                                                       SUM(idk.n_verificaciones) as n_repeticiones
                                                                FROM " . dblab . "info_day_kit as idk
                                                                WHERE idk.id_info_live_kit =" . $id);

        return $query;
    }

    public function get_table_info_live_kit($query)
    {

        $data            = array();
        $table           = dblab . 'info_live_kit';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value
        $wheresede       = $query['id_sede'] == 'all' ? '' : 'AND ilk.id_sedes = ' . $query['id_sede']; // Sede session users .



        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (date_start LIKE :date_start) ";
            $searchArray = array('date_start' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT id_info_live_kit,
                    ilk.referencia_interna,
                    ik.name_examen,
                    ilk.n_pruebas,
                    ilk.date_start,
                    ilk.date_expiration,
                    ilk.pruebas_permitidas,
                    ilk.estado,
                    se.name as sede                       
                    FROM " . dblab . "info_live_kit as ilk 
                    INNER JOIN " . dblab . "info_kit as ik  
                    ON (ilk.id_info_kit = ik.id_info_kit)  
                    INNER JOIN sedes as se  
                    ON (se.id_sedes = ilk.id_sedes)  
                    WHERE 1 " . $searchQuery . " " . $wheresede . "
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);

        foreach ($empRecords as $row) {
            $data[] = array(
                "sede"                => $row['sede'],
                "id_info_live_kit"    => $row['id_info_live_kit'],
                "referencia_interna"  => $row['referencia_interna'],
                "name_examen"         => $row['name_examen'],
                "n_pruebas"           => $row['n_pruebas'],
                "date_start"          => $row['date_start'],
                "date_expiration"     => $row['date_expiration'],
                "pruebas_permitidas"  => $row['pruebas_permitidas'],
                "estado"              => $row['estado']
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }


    public function get_table_costos_indirectos($query)
    {

        $data            = array();
        $table           = dblab . 'costos_indirectos_fabricacion';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (descripcion LIKE :descripcion) ";
            $searchArray = array('descripcion' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT id_costos_indirectos_fabricacion, se.name as 'sede', dc.descripcion, cif.valor, cif.ano_mes, cif.motivo_costos                       
                    FROM " . $table . " as cif
                    INNER JOIN sedes as se  
                    ON (se.id_sedes = cif.id_sede)
                    INNER JOIN " . dblab . "descripcion_costo as dc  
                    ON (dc.id_descripcion_costo = cif.id_descripcion_costo)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {
            $data[] = array(
                "id_costos_indirectos_fabricacion" => $row['id_costos_indirectos_fabricacion'],
                "sede"                             => $row['sede'],
                "descripcion"                      => $row['descripcion'],
                "valor"                            => $row['valor'],
                "motivo_costos"                    => $row['motivo_costos'],
                "ano_mes"                          => $row['ano_mes']
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }


    public function get_table_descripcion_costos($query)
    {

        $data            = array();
        $table           = dblab . 'descripcion_costo';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (descripcion LIKE :descripcion) ";
            $searchArray = array('descripcion' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT id_descripcion_costo, des.descripcion, al.descripcion as 'arealab', costo_fijo                        
                    FROM " . dblab . $table . " as des
                    INNER JOIN " . dblab . "areas_laboratorio as al  
                    ON (al.id_areas_laboratorio = des.id_area_laboratorio)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {
            $data[] = array(
                "id_descripcion_costo"  => $row['id_descripcion_costo'],
                "descripcion"           => $row['descripcion'],
                "arealab"               => $row['arealab'],
                "costo_fijo"            => $row['costo_fijo'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }


    public function get_table_gastos_fijos($query)
    {

        $data            = array();
        $table           = dblab . 'costos_fijos';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (descripcion LIKE :descripcion) ";
            $searchArray = array('descripcion' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT id_costos_fijos, des.descripcion, al.descripcion as 'arealab', valor                        
                    FROM " . dblab . $table . " as des
                    INNER JOIN " . dblab . "areas_laboratorio as al  
                    ON (al.id_areas_laboratorio = des.id_area_laboratorio)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {
            $data[] = array(
                "id_costos_fijos"       => $row['id_costos_fijos'],
                "ano_costo"             => date('Y', strtotime($row['fecha'])),
                "mes_costo"             => date('m', strtotime($row['fecha'])),
                "descripcion"           => $row['descripcion'],
                "arealab"               => $row['arealab'],
                "valor"                 => $row['valor'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }

    public function get_table_mano_obra($query)
    {

        $data            = array();
        $table           = 'mano_obra_directa';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (fecha LIKE :fecha) ";
            $searchArray = array('fecha' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT md.id_mano_obra_directa, al.descripcion as 'arealab',md.fecha,  
                           md.valor, md.tiempo_dedicacion, se.name as 'sede', sec.nombre  as 'seccion', 
                           CONCAT(' / <b> DOC: ',COALESCE(per.documento, ''),' - ',
                                                 COALESCE(per.nombre_1, ''),' ',
                                                 COALESCE(per.nombre_2, ''),' ',
                                                 COALESCE(per.apellido_1, ''),' ',
                                                 COALESCE(per.apellido_2, ''),'</b>') as 'empleado',  
                           car.nombre as 'cargo'                     
                    FROM " . dblab . $table . " as md
                    INNER JOIN " . dblab . "areas_laboratorio as al  
                    ON (al.id_areas_laboratorio = md.id_area_laboratorio)
                    INNER JOIN sedes as se  
                    ON (md.id_sede = se.id_sedes)
                    INNER JOIN seccion_empresa as sec  
                    ON (md.id_seccion_empresa = sec.id_seccion_empresa)
                    INNER JOIN empleados as em  
                    ON (em.id_empleados = md.id_empleado)
                    INNER JOIN persona as per  
                    ON (per.id_cw2_empleados = em.id_cw2_empleados)
                    INNER JOIN cargos as car  
                    ON (car.id_cargos = md.id_cargo)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {

            $data[] = array(
                "id_mano_obra_directa"  => $row['id_mano_obra_directa'],
                "ano_mes"               => $row['fecha'],
                "sede"                  => $row['sede'],
                "seccion_empresa"       => $row['seccion'],
                "arealab"               => $row['arealab'],
                "cargo_empleado"        => $row['cargo'] . '-' . $row['empleado'],
                "tiempo_dedicacion"     => $row['tiempo_dedicacion'],
                "valor"                 => $row['valor'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }


    public function get_table_examenes_empleados($query)
    {

        $data            = array();
        $table           = dblab . 'asignacion_pruebas_empleados';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (documento LIKE :documento) ";
            $searchArray = array('per.documento' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT ape.id_asignacion_pruebas_empleados, ex.nombre_examen  as 'examen', 
                           CONCAT(' <b> DOC: ',COALESCE(per.documento, ''),' - ',
                                                 COALESCE(per.nombre_1, ''),' ',
                                                 COALESCE(per.nombre_2, ''),' ',
                                                 COALESCE(per.apellido_1, ''),' ',
                                                 COALESCE(per.apellido_2, ''),'</b>') as 'empleado',  
                           ape.tiempo_prueba, ape.estado, ape.fecha_creacion
                    FROM " . dblab . $table . " as ape
                    INNER JOIN " . dblab . "info_kit as ik  
                    ON (ik.id_info_kit = ape.id_examenes)
                    LEFT JOIN " . dblab . "examenes as ex 
                    ON (ex.id_examenes = ik.id_examenes)
                    INNER JOIN " . dblab . "mano_obra_directa as mo  
                    ON (mo.id_mano_obra_directa = ape.id_empleados)
                    INNER JOIN empleados as em  
                    ON (em.id_empleados = mo.id_empleado)
                    LEFT JOIN persona as per  
                    ON (per.id_cw2_empleados = em.id_cw2_empleados)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {
            $empleado = '';
            $cargo    = '';
            $data[] = array(
                "id_asignacion_pruebas_empleados"  => $row['id_asignacion_pruebas_empleados'],
                "examen"                           => $row['examen'],
                "empleado"                         => $row['empleado'],
                "tiempo_prueba"                    => $row['tiempo_prueba'] . ' MIN',
                "fecha_creacion"                   => $row['fecha_creacion'],
                "estado"                           => $row['estado'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }



    public function get_table_examenes_costeados($query)
    {

        $data            = array();
        $table           = dblab . 'info_kit';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (name_examen LIKE :name_examen) ";
            $searchArray = array('ik.name_examen' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT * FROM " . $table . " as ik
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);

        foreach ($empRecords as $row) {

            $data[] = array(
                "id_info_kit"  => $row['id_info_kit'],
                "name_examen"  => $row['name_examen'],
                "codigo_cups"  => $row['codigo_cups'],
                "estado"       => $row['estado'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }


    public function get_table_productos_examenes($query)
    {

        $data            = array();
        $table           = dblab . 'asignacion_productos_examenes';
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value

        $totalRecords = $this->conexioPDO->count_datatables($table);

        $searchArray = array();
        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " AND (examen LIKE :examen) ";
            $searchArray = array('per.examen' => "%$searchValue%");
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray);

        // Fetch records
        $sql = "SELECT ape.id_asignacion_productos_examenes, ex.nombre_examen  as 'examen', 
                           pro.descripcion as 'producto', ape.fecha_creacion, ape.estado
                    FROM " . dblab . $table . " as ape
                    INNER JOIN " . dblab . "info_kit as ik  
                    ON (ik.id_info_kit = ape.id_examenes)
                    LEFT JOIN examenes as ex 
                    ON (ex.id_examenes = ik.id_examenes)
                    INNER JOIN " . dblab . "productos as pro  
                    ON (pro.id_productos = ape.id_productos)
                    WHERE 1 " . $searchQuery . "  
                    ORDER BY " . $columnName . " " . $columnSortOrder . " 
                    LIMIT :limit,:offset";

        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);


        foreach ($empRecords as $row) {
            $empleado = '';
            $cargo    = '';
            $data[] = array(
                "id_asignacion_productos_examenes"  => $row['id_asignacion_productos_examenes'],
                "examen"                            => $row['examen'],
                "producto"                          => $row['producto'],
                "fecha_creacion"                    => $row['fecha_creacion'],
                "estado"                            => $row['estado'],
            );
        }

        // Response
        $response = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data"            => $data
        );

        return  $response;
    }

    public function get_dinamic_query($sql, $searchArray)
    {

        $query = $this->conexioPDO->get_dinamic_query($sql, $searchArray);
        return $query;
    }


    public function sum_data($table, $where = array(), $operacion, $and, $join = '')
    {

        foreach ($where as $key => $value) {
            $and .= " AND " . $key . " = " . $value;
        }
        $sql = "SELECT " . $operacion . " as valor FROM " . $table . $join . " WHERE " . $and;
        $query = $this->conexioPDO->query($sql);
        return $query;
    }


    public function get_consumos_by_data($id, $date, $sede, $bono = 1)
    {

        $start =  date('Y-m-01', strtotime($date));
        $end   =  date('Y-m-t', strtotime($date));

        if (!isset($sede) or $sede != ' ') {
            $wheresede = ' AND ilk.id_sedes = ' . $sede . ' ';
        } else {
            $wheresede = ' ';
        }


        $sql = "SELECT AVG(ilk.pruebas_permitidas) AS 'nominales',
                           AVG(ilk.costo)              AS 'costo',
                           SUM(idk.n_calibradores)     AS 'calibradores', 
                           SUM(idk.n_controles)        AS 'controles',
                           SUM(idk.n_pruebas)          AS 'pruebas',
                           SUM(idk.n_verificaciones)   AS 'verificaciones',
                           SUM(idk.venc_equipos)   AS 'venc_equipos',
                           SUM(idk.n_diluciones)   AS 'n_diluciones'
                    FROM  " . dblab . "info_kit as ik
                    INNER JOIN  " . dblab . "info_live_kit as ilk  
                    ON (ilk.id_info_kit = ik.id_info_kit)
                    INNER JOIN  " . dblab . "info_day_kit as idk  
                    ON (idk.id_info_live_kit = ilk.id_info_live_kit)
                    WHERE ik.id_info_kit = " . $id . " " . $wheresede . "
                     AND ilk.bonificables = " . $bono . "  
                     AND idk.start between '" . $start . " 00:00:00' and '" . $end . " 23:59:00'";
        
        $query = $this->conexioPDO->query($sql);

        return $query;
    }
} //finde la clase UsersModel 
