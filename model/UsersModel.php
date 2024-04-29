<?php

    require_once './core/system/ModeloBase.php';

    class UsersModel extends ModeloBase{   

        private $table  = "users";
        
        public function __construct(){ 
            parent::__construct();
        }

        function get_user_by_id($id_users, $activated){

            $where = array('id_users'=> $id_users, 'activated' => $activated ? 1 : 0);
            $query = $this->conexioPDO->get_row($this->table, $where); 
            return $query;
        }

        public function get_user_by_login($login){ 

            $sql = "SELECT * FROM ".$this->table." WHERE username = '".strtolower($login)."' OR "." email  = '".strtolower($login)."'";
            //$where = array('username'=> strtolower($login),'email'=> strtolower($login));
            $query = $this->conexioPDO->query($sql); 
            return $query; 
        }

        public function get_user_by_username($login){

            $query = $this->conexioPDO->get_row($this->table, array('username'=> strtolower($login))); 
            return $query;
        }

        public function get_user_by_email($login){

            $query = $this->conexioPDO->get_row($this->table, array('email'=> strtolower($login))); 
            return $query; 
        }

        public function is_username_available($username){ 

            $where = array('LOWER(username)' => strtolower($username));
            $query = $this->db->getQueryCountRows($this->table);
            if($query == 0){ return TRUE; }else{ return FALSE; }
        }
        public function is_email_available($email){ 

            $where = array('LOWER(email)'       => strtolower($email),
                           'OR LOWER(new_email)'=> strtolower($email));
            $query = $this->db->getQueryCountRows($this->table, $where);
            if($query == 0){ return TRUE; }else{ return FALSE; }
         }

        public function create_userpro($data, $email_activation){

            $this->conexioPDO->insert($this->table, $data);
            return array('id_users'=> $this->conexioPDO->lastInsertId()); //return insert_id
        }

 
        //funciones especificas para el autologin del sistema
        public function user_autologin_get($id_users, $key){

            $sql = "SELECT users.id_users, users.username, userprofile.id_profiles
                    FROM users   
                    INNER JOIN user_autologin  
                    ON (users.id_users = user_autologin.id_users) 
                    INNER JOIN user_profiles 
                    ON (users.id_users = user_profiles.id_users) 
                    WHERE users.id_users = ".$id_users." 
                    AND user_autologin.key_id  = ".$key." 
                    AND userprofile.default = 1";
            return $this->conexioPDO->query($sql);
        }

        public function user_autologin_set($id_users,$key){

            return $this->conexioPDO->insert('user_autologin', array(
                'id_users' 		=> $id_users,
                'key_id'	 	=> $key,
                'user_agent' 	=> substr(user_agent, 0, 149),
                'last_ip' 		=> ip_address,
            ));
        }
        
        public function user_autologin_clear($id_users){

            $where = array('id_users' => $id_users);
            $this->conexioPDO->delete('user_autologin', $where);
        }
        public function user_autologin_delete($id_users, $key){

            $where = array('id_users' => $id_users, 'key_id' => $key);
            $this->conexioPDO->delete('user_autologin',$where);
        }

        public function user_autologin_purge($id_users){

            $where = array('id_users'=> $id_users,
	     	               'user_agent'=> substr(user_agent, 0, 149),
		                   'last_ip'=> ip_address);

            $this->conexioPDO->delete('user_autologin', $where);
        }


        public function update_login_info($id_users, $login_record_ip, $login_record_time){

            $where = array('id_users'=> $id_users);
            $data = array();
            if($login_record_ip   == TRUE){ $data['last_ip'] = ip_address; }
            $this->conexioPDO->update('user_autologin', $data, $where);

        } 

        public function get_attempts_num($ip_address, $login = null){ 

            $sql = "SELECT * FROM login_attempts WHERE ip_address =".$ip_address.' OR login = '.$login;      
            $query	= $this->conexioPDO->getQueryCountRows($sql);
            return $query;
        }

        public function increase_attempt($ip_address, $login){ 

            $data =  array('ip_address' => $ip_address, 'login' => $login);
            $this->conexioPDO->insert('login_attempts', $data);
        }

        public function clear_attempts($ip_address, $login, $expire_period){ 

            $where = array('ip_address'=> ip_address,
		                   'login' => $login,
                           'OR UNIX_TIMESTAMP(time) <'=> (time() - $expire_period));

            $this->conexioPDO->delete('login_attempts', $where);
        }


        public function get_modulos(){

            return $this->conexioPDO->get('modulos', array('estado' => 1));
        }

        public function get_submodulos_by_id_modulo($id){
            
            $query = $this->conexioPDO->get('submodulos', array('id_modulos'=> $id, 'estado' => 1)); 
            return $query; 
        } 

        public function get_submodulos_by_identificacion($id){
            
            $query = $this->conexioPDO->get_row('submodulos', array('identificacion'=> $id,'estado' => 1)); 
            return $query; 
        } 

        public function get_grupo_campos_by_id_grupomodulos($id){
            
            $query = $this->conexioPDO->get('grupo_campos', array('id_grupomodulos'=> $id)); 
            return $query; 
        }


        public function get_group_modulos_by_id($id){
            
            $sql = "SELECT sub.id_submodulos, sub.name, gr.id_grupomodulos, gr.name grupo, gr.identificacion
                    FROM submodulos As sub   
                    INNER JOIN grupomodulos As gr 
                    ON (gr.id_submodulos = sub.id_submodulos)
                    WHERE sub.identificacion = '".$id."'";
            return $this->conexioPDO->getRecFrmQry($sql);
        }



    } //finde la clase UsersModel

?>
