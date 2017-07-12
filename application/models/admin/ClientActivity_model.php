<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientActivity_model extends CI_Model {

    private $db_client_activity_table = 'client_activities';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
    }

    public function add_client_to_activity($activity_id, $client_id){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['activity_id'] = $activity_id;
        $insert_fields['client_id'] = $client_id;
        
        $this->db->insert($this->db_client_activity_table, $insert_fields);        
        $insert_id = $this->db->insert_id();        
        return $insert_id;
    }

    public function remove_client_from_activity($activity_id, $client_id){
        $this->db->where(array('activity_id' => $activity_id, 'client_id' => $client_id));
        $this->db->delete('client_activities');
        
        return $this->db->affected_rows();
    }   


    public function get_clients_by_activity_id($activity_id){

        $this->db->select('*');
        $this->db->from('client_activities ca');
        $this->db->join('clients c','c.ID = ca.client_id','inner');
        $this->db->where_in('ca.activity_id', $activity_id);
        
        $query = $this->db->get();

        return $query->result();

    }

    public function delete_activity($activity_id){
        $this->db->where('activity_id', $activity_id);
        $this->db->delete('client_activities');
        
        return $this->db->affected_rows();
    } 

}

