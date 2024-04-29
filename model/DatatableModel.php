<?php
require_once './core/system/ModeloBase.php';

class DatatableModel extends ModeloBase{

    public function __construct(){
        parent::__construct();
    }

    public function get_table_by_id($table, $id, $dbdefault){
        return $this->conexioPDO->get_row($dbdefault.$table, array('id_'.$table => $id));
    }

    public function get_data_table_by_id($table, $id){
        return $this->conexioPDO->get($table, $id);
    }


    public function get_list_data_by_id($sql){
        return $this->conexioPDO->getRecFrmQry($sql);
    }

    public function get_table($query){

        $data            = array();
        $draw            = $query['draw'];
        $row             = $query['row'];
        $rowperpage      = $query['rowperpage']; // Rows display per page
        $columnName      = $query['columnName']; // Column name
        $columnSortOrder = $query['columnSortOrder']; // asc or desc
        $searchValue     = $query['searchValue']; // Search value
        $table           = $query['dbdefault'].$query['table'];
        $id              = 'id_'.$query['table'];
        $campos          = $query['campos'];
        $searchs         = $query['searchs'];
        $select          = $query['select'];
        $searchArray     = array();
        $searchQuery     = '';
        $cond            = "AND";
        $join            = '';
      
        if(!empty($campos)){
            foreach ($campos as $cam) {
                if($cam['join'] == TRUE){
                    $join.= $cam['joinpotition']." JOIN ".$cam['jointable']." ON (".$cam['joinrelthis']." = ".$cam['joinrelchild'].")";
                }elseif(!empty($cam['sql']) AND $cam['sql']  == TRUE){
                    $join.=  $cam['sqlconsult'];
                }
            }
        }

        $totalRecords = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray, $join);

        if ($searchValue != '') {
            if(!empty($searchs)){ $i = 0;
                foreach ($searchs as $search){ $i++;
                    $cond = $i==1? "AND" : "OR";
                    $searchQuery .= $cond." (".$search." LIKE :".$search.") ";
                    $searchArray = array_merge($searchArray,array( $search => "%".$searchValue."%"));
                }
            }
        }

        $totalRecordwithFilter = $this->conexioPDO->count_datatables($table, $searchQuery, $searchArray, $join);

        // Fetch records
        $sql = "SELECT ".$select." FROM " .$table." ".$join." 
                WHERE 1 " . $searchQuery . "
                ORDER BY " . $columnName . " " . $columnSortOrder . "  
                LIMIT :limit,:offset";


        $empRecords = $this->conexioPDO->get_datatables($sql, $searchArray, $row, $rowperpage);

        if (!empty($empRecords)) {
            foreach ($empRecords as $row) {
                $datas = array('id' => $row[$id]);
                foreach ($campos as $camp) {
                    $datos = array($camp['name'] => $row[$camp['name']]);
                    $datas = array_merge($datas, $datos);
                }
                $data[] = $datas;
            }
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

    public function add_datatable($table, $data)
    {
        return $this->conexioPDO->insert($table, $data);
    }

    public function update_datatable($table, $data, $where)
    {
        return $this->conexioPDO->update($table, $data, $where);
    }


    public function delete_datatable($table, $where)
    {
        return $this->conexioPDO->delete($table, $where);
    }

}//end model
