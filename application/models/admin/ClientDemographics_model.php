<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientDemographics_model extends CI_Model {

    private $db_client_table = 'clients';
    private $db_status_info_table = 'clients_status_information';
    private $current_user_id;
    private $client_member_id_prefix = 'M100';
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;        
    }
    
    public function create( $fields = array() ){
        $insert_fields = array();        
        
        //$insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['member_id'] = $fields['member_id'];
        $insert_fields['is_member'] = !isset($fields['is_member']) ? 'N' : 'M';
        $insert_fields['first_name'] = $fields['first_name'];
        $insert_fields['last_name'] = $fields['last_name'];
        $insert_fields['email'] = $fields['email'];
        $insert_fields['ssn'] = $fields['ssn'];
        $insert_fields['date_of_birth'] = $fields['dob'];
        $insert_fields['gender'] = $fields['gender'];
        $insert_fields['home_address'] = $fields['home_address'];
        $insert_fields['city'] = $fields['city'];
        $insert_fields['state'] = $fields['state'];
        $insert_fields['zip'] = $fields['zip'];
        $insert_fields['phone'] = $fields['phone'];
        $insert_fields['alternative_phone'] = $fields['alternative_phone'];
        
        $this->db->insert($this->db_client_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        $this->_saveClientStatusInformation( $insert_id, $fields );
                                
        return $insert_id;          
    }
    
    public function update( $fields = array() ){
        $update_fields = array();        
        
        //$user_id = $fields['user_id'];
        $client_id = $fields['client_id'];
        $update_fields['is_member'] = !isset($fields['is_member']) ? 'N' : 'M';
        $update_fields['member_id'] = $fields['member_id'];
        $update_fields['first_name'] = $fields['first_name'];
        $update_fields['last_name'] = $fields['last_name'];
        $update_fields['email'] = $fields['email'];
        $update_fields['ssn'] = $fields['ssn'];
        $update_fields['date_of_birth'] = $fields['dob'];
        $update_fields['gender'] = $fields['gender'];
        $update_fields['home_address'] = $fields['home_address'];
        $update_fields['city'] = $fields['city'];
        $update_fields['state'] = $fields['state'];
        $update_fields['zip'] = $fields['zip'];
        $update_fields['phone'] = $fields['phone'];
        $update_fields['alternative_phone'] = $fields['alternative_phone'];
        
        $this->db->where('ID', $client_id);        
        $this->db->update($this->db_client_table, $update_fields); 
        
        if( is_object( $this->_checkIfClientHasStatusInfo( $client_id ) ) ){
            $this->_updateClientStatusInformation($client_id, $fields);
        }else{
            $this->_saveClientStatusInformation($client_id, $fields);
        }
                   
        return $this->db->affected_rows();
    }
    
    public function get_lists(){
        $this->db->select('b.ID, b.title, b.status, b.date_created, b.date_updated, u.first_name');
        $this->db->from('blog b');
        $this->db->join('users u','u.id = b.user_id','inner');
        $this->db->where_in('b.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function getCSVQueryExport(){
        $select_fields = 'c.member_id as Member_ID, c.email as Email, c.first_name as First_Name, c.last_name as Last_Name, c.gender as Gender,';
        $select_fields .= 'c.date_of_birth as Date_of_Birth, c.home_address as Home_Address, c.city as City, c.state as State, c.zip as Zip, c.phone as Phone, c.alternative_phone as Alternative_Phone,';
        $select_fields .= 'IF(cis.medicare_eligibility,"Yes","No") as Medicare_Eligibility, IF(cis.medicare_eligibility_active,"Yes","No") as Medicare_Eligibility_Active, cis.medicare_number as Medicare_Number, IF(cis.medicaid_eligibility,"Yes","No") as Medicaid_Eligibility, cis.medicaid_number as Medicaid_Number, cis.community_status as Community_Status,';
        $select_fields .= 'cis.marital_status as Marital_Status, cis.highest_completed_education as Highest_Completed_Education, cis.employment_status as Employment_Status, IF(cis.internet_access,"Yes","No") as Internet_Access, cis.type_of_income as Type_of_Income, cis.other_income as Other_Income,';
        $select_fields .= 'c.date_created as DateCreated';
        
        $this->db->select($select_fields);
        $this->db->from('clients c');
        $this->db->join('clients_status_information cis', 'cis.client_id = c.ID','left');
        
        $query = $this->db->get();
        
        return $query;
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('c.*, cis.*');
        $this->db->from('clients c');
        $this->db->join('clients_status_information cis', 'cis.client_id = c.ID','left');        
        $this->db->where('c.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function do_action( $type = '', $id = 0){
        if($type == 'deactivate'){
            $this->db->set('status', 0);
            $this->db->where('ID', $id);
            $this->db->update($this->db_client_table);
            
            return $this->db->affected_rows();
        }
    } 
    
    //Method that get auto generated formatted client member ID.
    public function setClientMemberID(){
        return $this->_generateClientMemberID();
    }
    
    private function _saveClientStatusInformation( $insert_id, $fields ){                
        $insert_status_infos = $this->_setClientInfoFields( $fields );
        
        if( count($insert_status_infos) > 0 ) {
            $insert_status_infos['client_id'] = $insert_id;            
            $insert_status_info_id = $this->db->insert($this->db_status_info_table, $insert_status_infos);
            
            return $insert_status_info_id;
        }    
        
        return false;
    }
    
    private function _updateClientStatusInformation( $client_id, $fields ){                        
        $update_status_infos = $this->_setClientInfoFields( $fields );
        
        if( count($update_status_infos) > 0 ) {            
            $this->db->where('client_id', $client_id);            
            $this->db->update($this->db_status_info_table, $update_status_infos);
            
            return $this->db->affected_rows();
        }    
        
        return false;
    }
    
    /* Prepare arrays of client status information fields for insert and update process */
    private function _setClientInfoFields( $fields ){
        $tbl_fields = $this->db->list_fields( $this->db_status_info_table );
        $status_info = array();
        
        foreach($tbl_fields as $tbl_field){
            if( isset($fields[ $tbl_field ]) ){
               $status_info[ $tbl_field ] = $fields[ $tbl_field ]; 
            }                
        }
                                       
        return $status_info;
    }
    
    private function _checkIfClientHasStatusInfo( $client_id ){
        $query = $this->db->get_where($this->db_status_info_table, array('client_id' => $client_id));        
        return $query->row();
    }
    
    private function _generateClientMemberID(){
        $this->db->select('MAX(ID) as max_id');
        $this->db->from($this->db_client_table);
        $prefix = $this->client_member_id_prefix . '-';
        
        $query = $this->db->get();
        
        if( $query->row() ){
            $member_id = $prefix . ($query->row()->max_id + 1);
        }else{
            $member_id = $prefix.'1';
        }
        
        return $member_id;
    }
}

