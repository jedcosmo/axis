<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientAssessment_model extends CI_Model {
    
    private $db_status_info_table = 'clients_assessment_status';
    private $current_user_id;    
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;        
    }
    
    public function create( $fields = array() ){
        $insert_fields = array();                         
        $insert_fields['client_id'] = $fields['client_id'];
        
        $insert_id = $this->_doLoopStatusKeyVal( $insert_fields, $fields );
        
        return $insert_id;          
    }
    
    public function update( $fields = array() ){
        $update_fields = array();                                    
        $update_fields['client_id'] = $fields['client_id'];
        
        $this->updateStatusKeyVal($update_fields, $fields);
        
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
    
    public function getClientAssessmentStatus( $client_id ){
       $this->db->select('*');
       $this->db->from($this->db_status_info_table);       
       $this->db->where('client_id', $client_id);
       
       $query = $this->db->get();
        
       return $query->result();
    }
    
    public function getCSVQueryExport(){
        $group_concat_str = $this->_prepareCSVAssessmentFormFieldNames();
        
        $query_str = "SELECT c.member_id AS MemberID, c.first_name AS FirstName, c.last_name AS LastName, cfh.history_date AS Date_Created                        
                        $group_concat_str
                        FROM `clients_assessment_status` AS cas
                        INNER JOIN clients AS c ON c.ID = cas.client_id
                        LEFT JOIN (
                            SELECT cfsh.client_id, MAX(cfsh.date_created) AS history_date 
                            FROM clients_form_submission_history AS cfsh 
                            GROUP BY cfsh.client_id) AS cfh ON cfh.client_id = cas.client_id
                        GROUP BY cas.`client_id`
                    ";
        $query = $this->db->query($query_str);
        
        return $query;
    }
    
    public function prepareClientAssessmentStatus( $client_id ){
        $group_array = array();
        $results = $this->getClientAssessmentStatus($client_id);
        if( is_array($results) && count($results) > 0 ){
            foreach($results as $r):
                if(array_key_exists($r->status_field, $group_array)){
                    if( !is_array($group_array[$r->status_field]) ){
                        $group_array[$r->status_field] = array($group_array[$r->status_field]);
                    }
                    
                    $group_array[$r->status_field][] = $r->status_value;
                }else{
                    $group_array[$r->status_field] = $r->status_value;
                }                
            endforeach;            
        }
        
        return $group_array;
    }
    
    public function updateStatusKeyVal($update_fields, $fields){
        $client_id = $fields['client_id'];
        $member_id = $fields['member_id'];
        
        $this->removeStatusKeyVal($client_id);
        $this->_doLoopStatusKeyVal( $update_fields, $fields );
    }
    
    public function removeStatusKeyVal($client_id){        
        $this->db->where('client_id', $client_id);
        $this->db->delete($this->db_status_info_table);
        error_log($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    public function insertStatusKeyVal( $item ){
        $this->db->insert($this->db_status_info_table, $item);        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    
    private function _doLoopStatusKeyVal( $insert_fields, $fields ){
        $excluded_key = array('member_id','client_id','save');        
        foreach($fields as $key => $val):                                    
            if( !is_array($val) && !in_array($key, $excluded_key) ){                
                $insert_fields['status_field'] = $key;
                $insert_fields['status_value'] = $val;                                                
                $insert_id = $this->insertStatusKeyVal( $insert_fields );
            }else{
                $this->_isArrayStatusVal($key, $val, $insert_fields);
            }             
        endforeach;
        
        return $insert_id;
    }
    
    private function _isArrayStatusVal( $key, $val, $additional = array()){        
        $array_fields = $additional;                
        if( is_array($val) && count($val) > 0 ){              
              foreach($val as $v){
                  $array_fields['status_field'] = $key;
                  $array_fields['status_value'] = $v;
                  
                  $insert_id = $this->insertStatusKeyVal( $array_fields );
              }
              
              return $insert_id;
        }
        
        return false;
    }
    
    private function _getCSVAssessmentFormFieldNames(){
        $this->db->select("cfrcf.`field_name`, IFNULL( CONCAT(cfrcf.field_name,'_',LOWER(REPLACE(REPLACE(cfrcf.`field_parent_label`,' ','_'),'/','')) ), cfrcf.`field_parent_label` ) AS field_name_with_parent");
        $this->db->from('`client_forms_radio_checkbox_fields` AS cfrcf');       
        $this->db->where('cfrcf.`form_type`', 'assessment');
        $this->db->group_by('cfrcf.field_name, cfrcf.`field_parent_label`');
        
        $query = $this->db->get();
                
        return $query->result();
    }
    
    private function _prepareCSVAssessmentFormFieldNames(){
        $group_concat_str = '';
        $fields = $this->_getCSVAssessmentFormFieldNames();
        $field_str = "GROUP_CONCAT(IF(cas.status_field = '{FIELD_KEY}', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS {FIELD_LABEL}";
        $group_separator = ',';    
        $group_concat_str = $group_separator;
        $group_ctr = 1;
        
        if( $fields ){            
            $group_count = count($fields);
            
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'physician_name', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Physician_Name,";
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'office_number', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Office_Number,";
            
            foreach($fields as $field){
                if( !is_null($field->field_name_with_parent) ){
                    $field_name = $field->field_name_with_parent;
                }else{
                    $field_name = $field->field_name;
                }
                
                $group_concat_str .= str_replace(array('{FIELD_KEY}', '{FIELD_LABEL}'), array($field_name, ucwords($field_name)), $field_str);
                
                if($group_ctr <= $group_count){
                    $group_concat_str .= $group_separator;
                }
                
                $group_ctr++;
            }
            
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'functional_limitations_notes', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Functional_Limitations_Notes,";
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'type_of_allergy', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Type_Of_Allergy,";
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'hospital_visit_related_to_notes', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Hospital_Visit_Related_to_Notes,";
            $group_concat_str .= "GROUP_CONCAT(IF(cas.status_field = 'axis_assesstment_notes', REPLACE(cas.status_value, '_', ' '), NULL) SEPARATOR ', ') AS Axis_Assesstment_Notes";                        
        }
        
        return $group_concat_str;
    }
}

