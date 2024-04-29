<?php
class ConectarPDO{
    /**
     * database connection object
     * @var \PDO
    */
    protected $pdo;
    /**
     * Connect to the database
     */
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION,);
    }
    /**
     * Return the pdo connection
     */
    public function getPdo(){
        return $this->pdo;
    }
    /**
     * Changes a camelCase table or field name to lowercase,
     * underscore spaced name
     *
     * @param  string $string camelCase string
     * @return string underscore_space string
     */
    protected function camelCaseToUnderscore($string){
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }
    /**
     * Returns the ID of the last inserted row or sequence value
     *
     * @param  string $param Name of the sequence object from which the ID should be returned.
     * @return string representing the row ID of the last row that was inserted into the database.
     */
    public function lastInsertId($param = null){
        return $this->pdo->lastInsertId($param);
    }
    /**
     *
     * Format for dynamic methods names -
     * Create:  insertTableName($arrData)
     * Retrieve: getTableNameByFieldName($value)
     * Update: updateTableNameByFieldName($value, $arrUpdate)
     * Delete: deleteTableNameByFieldName($value)
     *
     * @param  string     $function
     * @param  array      $arrParams
     * @return array|bool
     */
    public function __call($function, array $params = array()){

        if (! preg_match('/^(get|update|insert|delete)(.*)$/', $function, $matches)) {
            throw new \BadMethodCallException($function.' is an invalid method Call');
        }
 
        if ('insert' == $matches[1]) {
            if (! is_array($params[0]) || count($params[0]) < 1) {
                throw new \InvalidArgumentException('insert values must be an array');
            }
            return $this->insert($this->camelCaseToUnderscore($matches[2]), $params[0]);
        }
 
        list($tableName, $fieldName) = explode('By', $matches[2], 2);
        if (! isset($tableName, $fieldName)) {
            throw new \BadMethodCallException($function.' is an invalid method Call');
        }
         
        if ('update' == $matches[1]) {
            if (! is_array($params[1]) || count($params[1]) < 1) {
                throw new \InvalidArgumentException('update fields must be an array');
            }
            return $this->update(
                $this->camelCaseToUnderscore($tableName),
                $params[1],
                array($this->camelCaseToUnderscore($fieldName) => $params[0])
            );
        }
 
        //select and delete method
        return $this->{$matches[1]}(
            $this->camelCaseToUnderscore($tableName),
            array($this->camelCaseToUnderscore($fieldName) => $params[0])
        );
    }
 
    /**
     * Record retrieval method
     *
     * @param  string     $tableName name of the table
     * @param  array      $where     (key is field name)
     * @return array|bool (associative array for single records, multidim array for multiple records)
     */
    public function get($tableName,  $whereAnd  =   array(), $whereOr   =   array(), $whereLike =   array()){

            $cond   =   '';
            $s      = 1;
            $params =   array();

            foreach($whereAnd as $key => $val){
                $cond   .=  " And ".$key." = :a".$s;
                $params['a'.$s] = $val;
                $s++;
            }

            foreach($whereOr as $key => $val){
                $cond   .=  " OR ".$key." = :a".$s;
                $params['a'.$s] = $val;
                $s++;
            }

            foreach($whereLike as $key => $val){
                $cond   .=  " OR ".$key." like '% :a".$s."%'";
                $params['a'.$s] = $val;
                $s++;
            }

            $stmt = $this->pdo->prepare("SELECT  $tableName.* FROM $tableName WHERE 1 ".$cond);
            try {
                $stmt->execute($params);
                $res = $stmt->fetchAll();
                if (! $res || count($res) != 1) { $res; }  
                return $res;

            } catch (\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
    }

     
     /**
     * Insert Method
     *
     * @param  string $tableName
     * @param  array  $arrData   (data to insert, associative where key is field name)
     * @return int    number of affected rows
     */

    public function insert($tableName, array $data){

        $stmt = $this->pdo->prepare("INSERT INTO $tableName (".implode(',', array_keys($data)).")
                                      VALUES (".implode(',', array_fill(0, count($data), '?')).")");
        try{
              $stmt->execute(array_values($data));
              return $stmt->rowCount();
        }catch(\PDOException $e){ 
            //Crear un manejador de errores del sistema para no imprimir errores en pantalla
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); 
        }
    }
     
    /**
     * Update Method
     *
     * @param  string $tableName
     * @param  array  $set       (associative where key is field name)
     * @param  array  $where     (associative where key is field name)
     * @return int    number of affected rows
     */

    public function update($tableName, array $set, array $where){

        $arrSet = array_map( function($value) { return $value . '=:' . $value; },
                  array_keys($set));
             
        $stmt = $this->pdo->prepare("UPDATE $tableName SET ". implode(',', $arrSet).' 
                                     WHERE '. key($where). '=:'. key($where) . 'Field');
 
        foreach ($set as $field => $value){ $stmt->bindValue(':'.$field, $value); }
        $stmt->bindValue(':'.key($where) . 'Field', current($where));
        try{
            $stmt->execute();
            return $stmt->rowCount();
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
    }
    
 
    /**
     * Delete Method
     *
     * @param  string $tableName
     * @param  array  $where     (associative where key is field name)
     * @return int    number of affected rows
     */
    public function delete($tableName, array $where) {

        $stmt = $this->pdo->prepare("DELETE FROM ".$tableName." WHERE ".key($where) . ' = ?');
        try{ $stmt->execute(array(current($where)));
             return $stmt->rowCount();
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

    }


    public function query($sql){
        $sth = $this->pdo->query($sql);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllRecords($tableName, $fields='*', $cond='', $orderBy='', $limit=''){

        $stmt = $this->pdo->prepare("SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit);
        try{ $stmt->execute();
             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $rows;
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
    }
     
    public function getRecFrmQry($query){

        $stmt = $this->pdo->prepare($query);
        try{ $stmt->execute();
             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $rows;
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

    }
     
    public function getRecFrmQryStr($query){

        $stmt = $this->pdo->prepare($query);
        try{ $stmt->execute();
             return array();
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

    }

    public function getQueryCount($tableName, $field, $cond=''){

        $stmt = $this->pdo->prepare("SELECT count($field) as total FROM $tableName WHERE 1 ".$cond);
        try{  $stmt->execute();
              $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if (! $res || count($res) != 1) { return $res; }
              return $res;
        }catch(\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

    }


    public function get_row($tableName, $where = array()){
        
        $cond   =   '';
        $s      = 1;
        $params =   array();

        foreach($where as $key => $val){
            $cond   .=  " And ".$key." = :a".$s;
            $params['a'.$s] = $val;
            $s++;
        }

        $stmt = $this->pdo->prepare("SELECT  $tableName.* FROM $tableName WHERE 1 ".$cond);
        try { $stmt->execute($params);
              return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
        
    }

    public function getQueryCountRows($sql){
        $sth = $this->pdo->prepare($sql);
        return $sth->rowCount();
    }


    //datatablet function

    public function count_datatables($table, $searchQuery = '', $searchArray = array(), $join = ''){

        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS allcount FROM ".$table." ".$join." WHERE 1 ".$searchQuery);
        try { $stmt->execute($searchArray);
              $records = $stmt->fetch();
              $totalRecordwithFilter = $records['allcount'];
              return $totalRecordwithFilter;
        } catch (\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

         
    }

    public function get_datatables($sql, $searchArray, $row, $rowperpage){ 

        // Fetch records
        $stmt = $this->pdo->prepare($sql);

        try {
            // Bind values
            foreach ($searchArray as $key => $search){ $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR); }
            $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
            $stmt->execute();
            $empRecords = $stmt->fetchAll();
            return $empRecords;
        } catch (\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }

    }

    public function get_dinamic_query($sql, $searchArray){

        $stmt = $this->pdo->prepare($sql);
        try {
            foreach ($searchArray as $key => $search) { $stmt->bindValue(':'.$key, $search, PDO::PARAM_STR); }
            $stmt->execute();
            $Records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $Records;
        } catch (\PDOException $e){ throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
    }
  
    /**
     * Print array Method
     *
     * @param  array 
     */
    public function arprint($array){

        print"<pre>";
        print_r($array);
        print"</pre>";
    }
    
    /**
     * Cache Method
     *
     * @param  string QUERY
     * @param  Int Time default 0 set 
     */
   public function getCache($sql, $filePath, $cache_min = 0) {

	  $f = $filePath.md5($sql);
      if ($cache_min!=0 and file_exists($f) and ( (time()-filemtime($f))/60 < $cache_min )){
            $arr = unserialize(file_get_contents($f));
      }else{
            unlink($f);
            $arr = self::getRecFrmQry($sql);
            if ($cache_min!=0) {
                $fp = fopen($f,'w');
                fwrite($fp,serialize($arr));
                fclose($fp);
            }
      }
      return $arr;
    }

     
} //fin de la clase conexion PDO ?>
