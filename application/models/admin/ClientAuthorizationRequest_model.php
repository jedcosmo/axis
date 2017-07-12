<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientAuthorizationRequest_model extends CI_Model {
    
    private $db_auth_req_table = 'clients_authorization_requests';
    private $current_user_id;    
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;        
    }
    
    public function create( $fields = array() ){
        $insert_fields = array();                         
        $insert_fields['client_id'] = $fields['client_id'];
        
        $insert_id = $this->_doLoopKeyVal( $insert_fields, $fields );
        
        return $insert_id;          
    }
    
    public function update( $fields = array() ){
        $update_fields = array();                                    
        $update_fields['client_id'] = $fields['client_id'];
        
        $this->updateKeyVal($update_fields, $fields);
        
        return true;
    }
    
    public function get_lists(){
        $this->db->select('b.ID, b.title, b.status, b.date_created, b.date_updated, u.first_name');
        $this->db->from('blog b');
        $this->db->join('users u','u.id = b.user_id','inner');
        $this->db->where_in('b.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }        
    
    public function getClientAuthorizationRequests( $client_id ){
       $this->db->select('*');
       $this->db->from($this->db_auth_req_table);       
       $this->db->where('client_id', $client_id);
       
       $query = $this->db->get();
        
       return $query->result();
    }
    
    public function getCSVQueryExport(){
        $query_str = "SELECT c.member_id AS MemberID, c.first_name AS FirstName, c.last_name AS LastName,                        
                        GROUP_CONCAT(IF(car.field = 'goals', car.value, NULL) SEPARATOR ', ') AS Goals,
                        GROUP_CONCAT(IF(car.field = 'program_interventions', car.value, NULL) SEPARATOR ', ') AS Program_Interventions,
                        cfh.history_date AS Date_Created
                        FROM `clients_authorization_requests` AS car 
                        INNER JOIN clients AS c ON c.ID = car.client_id
                        LEFT JOIN (
                            SELECT cfsh.client_id, MAX(cfsh.date_created) AS history_date 
                            FROM clients_form_submission_history AS cfsh 
                            GROUP BY cfsh.client_id) AS cfh ON cfh.client_id = car.client_id
                        GROUP BY car.client_id
                     ";
        
        $query = $this->db->query($query_str);
        
        return $query;
    }
    
    public function prepareClientAuthorizationRequests( $client_id ){
        $group_array = array();
        $results = $this->getClientAuthorizationRequests($client_id);
        if( is_array($results) && count($results) > 0 ){
            foreach($results as $r):
                if(array_key_exists($r->field, $group_array)){
                    if( !is_array($group_array[$r->field]) ){
                        $group_array[$r->field] = array($group_array[$r->field]);
                    }
                    
                    $group_array[$r->field][] = $r->value;
                }else{
                    $group_array[$r->field] = $r->value;
                }                
            endforeach;            
        }
        
        return $group_array;
    }
    
    public function updateKeyVal($update_fields, $fields){
        $client_id = $fields['client_id'];
        $member_id = $fields['member_id'];
        
        $this->removeKeyVal($client_id);
        $this->_doLoopKeyVal( $update_fields, $fields );
    }
    
    public function removeKeyVal($client_id){        
        $this->db->where('client_id', $client_id);
        $this->db->delete($this->db_auth_req_table);
        error_log($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    public function insertKeyVal( $item ){        
        $this->db->insert($this->db_auth_req_table, $item);        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
        
    private function _doLoopKeyVal( $insert_fields, $fields ){
        $excluded_key = array('member_id','client_id','save');        
        foreach($fields as $key => $val):                                    
            if( !is_array($val) && !in_array($key, $excluded_key) ){                
                $insert_fields['field'] = $key;
                $insert_fields['value'] = $val;                                 
                $insert_id = $this->insertKeyVal( $insert_fields );
            }else{
                $this->_isArrayVal($key, $val, $insert_fields);
            }             
        endforeach;
        
        return $insert_id;
    }
    
    private function _isArrayVal( $key, $val, $additional = array()){        
        $array_fields = $additional;                
        if( is_array($val) && count($val) > 0 ){              
              foreach($val as $v){
                  $array_fields['field'] = $key;
                  $array_fields['value'] = $v;
                                    
                  $insert_id = $this->insertKeyVal( $array_fields );
              }
              
              return $insert_id;
        }
        
        return false;
    }
}

