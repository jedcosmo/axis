<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends CI_Model {

    private $db_client_table = 'clients';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
    }

     public function create( $fields = array(), $member_id ){
        $insert_fields = array();        
        
        $insert_fields['member_id'] = $member_id;
        $insert_fields['is_member'] = !isset($fields['is_member']) ? 'N' : 'M';
        $insert_fields['first_name'] = $fields['first_name'];
        $insert_fields['last_name'] = $fields['last_name'];
        $insert_fields['email'] = $fields['email'];
        $insert_fields['ssn'] = !isset($fields['ssn']) ? '' : $fields['ssn'];
        $insert_fields['date_of_birth'] = !isset($fields['dob']) ? '' : $fields['dob'];
        $insert_fields['gender'] = !isset($fields['gender']) ? '' : $fields['gender'];
        $insert_fields['home_address'] = !isset($fields['home_address']) ? '' : $fields['home_address'];
        $insert_fields['city'] = !isset($fields['city']) ? '' : $fields['city'];
        $insert_fields['state'] = !isset($fields['state']) ? '' : $fields['state'];
        $insert_fields['zip'] = !isset($fields['zip']) ? '' : $fields['zip'];
        $insert_fields['phone'] = $fields['phone'];
        
        $this->db->insert($this->db_client_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
                                
        return $insert_id;          
    }

    public function get_details($id = 0){
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

    public function get_lists_clients(){
        
        $this->db->select('*');
        $this->db->order_by('first_name', 'ASC');
        $this->db->from('clients');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_clients($q, $fields = false){
        
        if($fields){
            $this->db->select($fields);
        }else{
            $this->db->select('*');
        }
        
        $this->db->or_like(array('last_name' => $q , 'first_name' => $q));
        $this->db->from('clients');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getClientSummaryDetailsByMemberID( $member_id ){
        $this->db->select('ID, member_id, first_name, last_name');
        $this->db->from('clients');
        
        if(is_numeric($member_id)){
            $this->db->where('ID', $member_id); 
        }else{
            $this->db->where('member_id', $member_id);
        }                
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function getClientsListsSummary(){
        $query = $this->db->query('SELECT c.ID, c.member_id, c.first_name, c.last_name, c.ssn, c.date_created, c.is_member, cas_join.cas_count, car_join.car_count, cia_join.cia_count
                                   FROM clients c
                                   LEFT JOIN (
                                        SELECT cas.client_id, COUNT(cas.client_id) as cas_count 
                                        FROM clients_assessment_status cas GROUP BY cas.client_id
                                   ) as cas_join ON cas_join.client_id = c.ID
                                   LEFT JOIN (
                                        SELECT car.client_id, COUNT(car.client_id) as car_count 
                                        FROM clients_authorization_requests car GROUP BY car.client_id
                                   ) as car_join ON car_join.client_id = c.ID
                                   LEFT JOIN (
                                        SELECT cia.client_id, COUNT(cia.client_id) as cia_count 
                                        FROM clients_initial_assessment cia GROUP BY cia.client_id
                                   ) as cia_join ON cia_join.client_id = c.ID
                                 ');        
        
        return $query->result();
    }
    
    public function logClientFormEventHistory( $log_fields ){
        $log_fields['user_id'] = $this->current_user_id;
        
        $this->db->insert('clients_form_submission_history', $log_fields);
        return $this->db->insert_id();
    }

    public function create_member( $fields = array(), $member_id ){
        $insert_fields = array();        
        
        $insert_fields['member_id'] = $member_id;
        $insert_fields['is_member'] = 'N';
        $insert_fields['first_name'] = $fields['member_first_name'];
        $insert_fields['last_name'] = $fields['member_last_name'];
        $insert_fields['email'] = $fields['member_email'];
        $insert_fields['date_of_birth'] = !isset($fields['member_dob']) ? '' : $fields['member_dob'];
        $insert_fields['gender'] = !isset($fields['member_gender']) ? '' : $fields['member_gender'];
        $insert_fields['phone'] = $fields['member_phone'];
        $insert_fields['home_address'] = !isset($fields['member_address']) ? '' : $fields['member_address'];
        $insert_fields['city'] = !isset($fields['member_city']) ? '' : $fields['member_city'];
        $insert_fields['state'] = !isset($fields['member_state']) ? '' : $fields['member_state'];
        $insert_fields['zip'] = !isset($fields['member_zip']) ? '' : $fields['member_zip'];
        
        $this->db->insert($this->db_client_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
                                
        return $insert_id;          
    }

    public function create_volunteer( $fields = array(), $member_id ){
        $insert_fields = array();        
        
        $insert_fields['member_id'] = $member_id;
        $insert_fields['is_member'] = 'N';
        $insert_fields['first_name'] = $fields['volunteer_first_name'];
        $insert_fields['last_name'] = $fields['volunteer_last_name'];
        $insert_fields['email'] = $fields['volunteer_email'];
        $insert_fields['date_of_birth'] = $fields['volunteer_dob'];
        $insert_fields['gender'] = $fields['volunteer_gender'];
        $insert_fields['phone'] = $fields['volunteer_phone'];
        
        $this->db->insert($this->db_client_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
                                
        return $insert_id;          
    }
}

